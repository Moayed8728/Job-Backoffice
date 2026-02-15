<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('job-applications.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                ⬅️ Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $jobApplication->user->name }} | Applied to {{ $jobApplication->jobVacancy->title }}
            

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

        <!-- Job Application Card -->
        <div class="bg-white shadow rounded-lg p-6 space-y-6">

            <!-- Job Application Information -->
            <div>
                <h3 class="text-lg font-bold mb-4">Job Application Information</h3>
                <p><strong>Applicant:</strong> {{ $jobApplication->user->name }}</p>
                <p><strong>Job Vacancy:</strong> {{ $jobApplication->jobVacancy->title }}</p>
                <p><strong>Company:</strong> {{ $jobApplication->jobVacancy->company->name }}</p>
                
                <p>
    <strong>Status:</strong> 
    <span @class([
            'font-semibold',
            'text-green-600' => $jobApplication->status === 'Accepted',
            'text-red-600' => $jobApplication->status === 'Rejected',
            'text-gray-900' => $jobApplication->status === 'Pending',
            ])>
            {{ $jobApplication->status }}
        </span>
    </p>


                <p><strong>Resume:</strong> 
                    <a class="text-blue-500 hover:text-blue-700 underline"
                       href="{{ $jobApplication->resume->fileUrl }}" target="_blank">
                       {{ $jobApplication->resume->fileUrl }}
                    </a>
                </p>

                <div class="mt-4 flex space-x-3">
                    <a href="{{ route('job-applications.edit', ['job_application' => $jobApplication->id, 'redirectToList' => 'false']) }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-800">✍️ Edit</a>

                    <form action="{{ route('job-applications.destroy', $jobApplication->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to archive this job application?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800">🗃️ Archive</button>
                    </form>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="border-b border-gray-200 flex space-x-4">
                <a href="{{ route('job-applications.show', ['job_application' => $jobApplication->id, 'tab' => 'resume']) }}"
                   class="px-4 py-2 {{ request('tab', 'resume') == 'resume' ? 'border-b-2 border-blue-600 font-semibold' : 'text-gray-600' }}">
                    Resume
                </a>
                <a href="{{ route('job-applications.show', ['job_application' => $jobApplication->id, 'tab' => 'aifeedback']) }}"
                   class="px-4 py-2 {{ request('tab') == 'aifeedback' ? 'border-b-2 border-blue-600 font-semibold' : 'text-gray-600' }}">
                    AI Feedback
                </a>
            </div>

            <!-- Resume Tab -->
            <div id="resume" class="{{ request('tab', 'resume') == 'resume' ? 'block' : 'hidden' }} mt-4">
                <table class="min-w-full bg-white rounded-lg shadow">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 text-left bg-gray-100">Summary</th>
                            <th class="py-2 px-4 text-left bg-gray-100">Skills</th>
                            <th class="py-2 px-4 text-left bg-gray-100">Experience</th>
                            <th class="py-2 px-4 text-left bg-gray-100">Education</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">{{ $jobApplication->resume->summary }}</td>
                            <td class="py-2 px-4">{{ $jobApplication->resume->skills }}</td>
                            <td class="py-2 px-4">{{ $jobApplication->resume->experience }}</td>
                            <td class="py-2 px-4">{{ $jobApplication->resume->education }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- AI Feedback Tab -->
            <div id="aifeedback" class="{{ request('tab') == 'aifeedback' ? 'block' : 'hidden' }} mt-4">
                <table class="min-w-full bg-white rounded-lg shadow">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 text-left bg-gray-100">AI Score</th>
                            <th class="py-2 px-4 text-left bg-gray-100">Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">{{ $jobApplication->aiGeneratedScore }}</td>
                            <td class="py-2 px-4">{{ $jobApplication->aiGeneratedFeedback }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>