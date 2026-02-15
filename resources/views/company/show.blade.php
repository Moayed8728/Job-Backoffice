<x-app-layout>
    <x-slot name="header">
        @if (auth()->user()->role == 'admin')
        <div class="flex items-center space-x-4">
            <a href="{{ route('companies.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                ⬅️ Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $company->name }}
            </h2>
        </div>
        @endif
    </x-slot>

    <div class="p-6 space-y-6">

        <!-- Company Information -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4">Company Information</h3>
            <p><strong>Name:</strong> {{ $company->owner->name }}</p>
            <p><strong>Email:</strong> {{ $company->owner->email }}</p>
            <p><strong>Address:</strong> {{ $company->address }}</p>
            <p><strong>Industry:</strong> {{ $company->industry }}</p>
            <p><strong>Website:</strong> 
                @if($company->website)
                    <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:underline">
                        {{ $company->website }}
                    </a>
                @else
                    N/A
                @endif
            </p>


            <!-- Action Buttons -->
            <div class="mt-4 flex space-x-3">
                @if(auth()->user()->role == 'company-owner')
                <a href="{{ route('my-company.edit',  ['company' => $company->id]) }}" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-800">✍️ Edit</a>
                @endif
                
                   @if(auth()->user()->role == 'admin')
                   <a href="{{ route('companies.edit',  ['company' => $company->id, 'redirectToList' => 'false']) }}" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-800">✍️ Edit</a>
 
                   <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to archive this company?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800">🗃️ Archive</button>
                </form>
                @endif
            </div>
        </div>

        
        @if (auth()->user()->role == 'admin')
        <!-- Tabs Navigation -->
        <div class="flex border-b mb-4">
            <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'jobs']) }}"
               class="px-4 py-2 {{ request('tab') == 'jobs' || request('tab') == '' ? 'border-b-2 border-blue-600 font-semibold' : 'text-gray-600' }}">
                Jobs
            </a>
            <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'applications']) }}"
               class="px-4 py-2 {{ request('tab') == 'applications' ? 'border-b-2 border-blue-600 font-semibold' : 'text-gray-600' }}">
                Applications
            </a>
        </div>
        
        
        <!-- Jobs Tab -->
        <div id="jobs" class="{{ request('tab') == 'jobs' || request('tab') == '' ? 'block' : 'hidden' }}">
            <h3 class="text-lg font-bold mb-3">Jobs</h3>
            @if($company->jobVacancies->count())
                <table class="min-w-full bg-white rounded-lg shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left">Title</th>
                            <th class="py-2 px-4 text-left">Type</th>
                            <th class="py-2 px-4 text-left">Location</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($company->jobVacancies as $job)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $job->title }}</td>
                                <td class="py-2 px-4">{{ $job->type }}</td>
                                <td class="py-2 px-4">{{ $job->location }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('job-vacancies.show', $job->id) }}" class="text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No jobs available.</p>
            @endif
        </div>

        <!-- Applications Tab -->
        <div id="applications" class="{{ request('tab') == 'applications' ? 'block' : 'hidden' }}">
            <h3 class="text-lg font-bold mb-3">Applications</h3>
            @if($company->jobApplications->count())
                <table class="min-w-full bg-white rounded-lg shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left">Applicant Name</th>
                            <th class="py-2 px-4 text-left">Job Title</th>
                            <th class="py-2 px-4 text-left">Status</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($company->jobApplications as $application)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $application->user->name }}</td>
                                <td class="py-2 px-4">{{ $application->jobVacancy->title }}</td>
                                <td class="py-2 px-4">{{ $application->status }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('job-applications.show', $application->id) }}" class="text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No applications available.</p>
            @endif
        </div>
        @endif
    </div>
</x-app-layout>
