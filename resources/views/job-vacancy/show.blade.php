<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('job-vacancies.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                ⬅️ Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $jobVacancy->name }}
            </h2>
        </div>
    </x-slot>

    @if(session('success') || session('error'))
    <div x-data="{ show: true }" x-show="show"
         x-init="setTimeout(() => show = false, 3000)"
         class="mb-4 px-4 py-2 rounded
                {{ session('success') ? 'bg-green-100 text-green-800' : '' }}
                {{ session('error') ? 'bg-red-100 text-red-800' : '' }}">
        {{ session('success') ?? session('error') }}
    </div>
@endif


    <div class="p-6 space-y-6">

        <!-- Big Card containing Job Info + Applications -->
        <div class="bg-white shadow rounded-lg p-6 space-y-6">

            <!-- Job Vacancy Information -->
            <div>
                <h3 class="text-lg font-bold mb-4">Job Vacancy Information</h3>
                <p><strong>Company:</strong> {{ $jobVacancy->company->name }}</p>
                <p><strong>Location:</strong> {{ $jobVacancy->location }}</p>
                <p><strong>Type:</strong> {{ $jobVacancy->type }}</p>
                <p><strong>Salary:</strong> ${{ number_format($jobVacancy->salary, 2) }}</p>
                <p><strong>Description:</strong> {{ $jobVacancy->description }}</p>

                <!-- Action Buttons -->
                <div class="mt-4 flex space-x-3">
                    <a href="{{ route('job-vacancies.edit',  ['job_vacancy' => $jobVacancy->id, 'redirectToList' => 'false']) }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-800">✍️ Edit</a>

                    <form action="{{ route('job-vacancies.destroy', $jobVacancy->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to archive this jobVacancy?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800">🗃️ Archive</button>
                    </form>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="border-b border-gray-200">
                <a href="{{ route('job-vacancies.show', ['job_vacancy' => $jobVacancy->id, 'tab' => 'applications']) }}"
                   class="px-4 py-2 {{ (request('tab', 'applications') == 'applications') ? 'border-b-2 border-blue-600 font-semibold' : 'text-gray-600' }}">
                    Applications
                </a>
            </div>

            <!-- Applications Table inside the same card -->
            <div id="applications" class="{{ (request('tab', 'applications') == 'applications') ? 'block' : 'hidden' }} mt-4">
                <h3 class="text-lg font-bold mb-3">Applications</h3>
                @if($jobVacancy->jobApplications->count())
                    <div class="overflow-x-auto">
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
                                @foreach($jobVacancy->jobApplications as $application)
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
                    </div>
                @else
                    <p class="text-gray-500">No applications available.</p>
                @endif
            </div>

        </div>

    </div>
</x-app-layout>
