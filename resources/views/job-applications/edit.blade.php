<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <a href="{{ route('job-applications.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                ⬅️ Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Applicant Status') }}
            </h2>
        </div>
    </x-slot>

    <!-- Flash Messages -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show"
             x-init="setTimeout(() => show = false, 3000)"
             class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show"
             x-init="setTimeout(() => show = false, 3000)"
             class="mb-4 px-4 py-2 rounded bg-red-100 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <div class="p-6">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 border-b pb-3">
                Job Application Details
            </h3>

            <form method="POST" 
                  action="{{ route('job-applications.update', ['job_application' => $jobApplication->id, 'redirectToList' => request()->query('redirectToList')]) }}" 
                  class="space-y-6">

                @csrf
                @method('PUT')

                <!-- Applicant Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Applicant Name</label>
                    <span>{{ $jobApplication->user->name ?? 'N/A' }}</span>
                </div>

                <!-- Job Vacancy -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Job Vacancy</label>
                    <span>{{ $jobApplication->jobVacancy->title }}</span>
                </div>

                <!-- Company -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Company</label>
                    <span>{{ $jobApplication->jobVacancy->company->name }}</span>
                </div>

                <!-- AI Score -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">AI Generated Score</label>
                    <span>{{ $jobApplication->aiGeneratedScore ?? 'N/A' }}</span>
                </div>

                <!-- AI Feedback -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">AI Generated Feedback</label>
                    <span>{{ $jobApplication->aiGeneratedFeedback ?? 'N/A' }}</span>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 
                               focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="Pending" {{ old('status', $jobApplication->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Rejected" {{ old('status', $jobApplication->status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="Accepted" {{ old('status', $jobApplication->status) == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                    </select>
                </div>

                <!-- Form Buttons -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('job-applications.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md 
                              hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md 
                                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Applicant Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
