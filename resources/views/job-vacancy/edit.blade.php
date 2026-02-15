<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <a href="{{ route('job-vacancies.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                ⬅️ Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Job Vacancy') }}
            </h2>
        </div>
    </x-slot>

    <!-- Flash Messages -->
@if(session('success') || session('error'))
    <div x-data="{ show: true }" x-show="show"
         x-init="setTimeout(() => show = false, 3000)"
         class="mb-4 px-4 py-2 rounded
                {{ session('success') ? 'bg-green-100 text-green-800' : '' }}
                {{ session('error') ? 'bg-red-100 text-red-800' : '' }}">
        {{ session('success') ?? session('error') }}
    </div>
@endif


    <div class="p-6">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 border-b pb-3">
                 Job Vacancy Deatils
            </h3>

            <form method="POST" action="{{ route('job-vacancies.update', ['job_vacancy' => $jobVacancy->id, 'redirectToList' => request()->query('redirectToList')]) }}" class="space-y-6">

                @csrf
                @method('PUT')

                <!-- Job Vacancy Details (all grouped together) -->
                <div class="mb-4 p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold mb-4">Job Vacancy Details</h3>

                    <!-- Job Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $jobVacancy->title) }}"
                               class="mt-2 block w-full rounded-md border px-3 py-2
                                      {{ $errors->has('title') ? 'border-red-600' : 'border-gray-300' }}"
                               placeholder="Enter Job Title" required>
                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Location -->
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location',$jobVacancy->location) }}"
                               class="mt-2 block w-full rounded-md border px-3 py-2
                                      {{ $errors->has('location') ? 'border-red-600' : 'border-gray-300' }}"
                               placeholder="Enter Location" required>
                        @error('location')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Salary -->
                    <div class="mb-4">
                        <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                        <input type="number" name="salary" id="salary" value="{{ old('salary',$jobVacancy->salary) }}"
                               class="mt-2 block w-full rounded-md border px-3 py-2
                                      {{ $errors->has('salary') ? 'border-red-600' : 'border-gray-300' }}"
                               placeholder="Enter Salary">
                        @error('salary')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job Type -->
<div class="mb-4">
    <label for="type" class="block text-sm font-medium text-gray-700">Job Type</label>
    <select name="type" id="type"
            class="mt-2 block w-full rounded-md border px-3 py-2
                   {{ $errors->has('type') ? 'border-red-600' : 'border-gray-300' }}" required>
        <option value="">Select Type</option>
        <option value="Full-time" {{ old('type',$jobVacancy->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
        <option value="Part-time" {{ old('type', $jobVacancy->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
        <option value="Remote" {{ old('type',$jobVacancy->type) == 'Remote' ? 'selected' : '' }}>Remote</option>
        <option value="Hybrid" {{ old('type',$jobVacancy->type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
    
    </select>
    @error('type')
    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>


                    

                    <!-- Company select -->
<div class="mb-4">
    <label for="companyId" class="block text-sm font-medium text-gray-700">Select Company</label>
    <select name="companyId" id="companyId"
            class="mt-2 block w-full rounded-md border px-3 py-2
                   {{ $errors->has('companyId') ? 'border-red-600' : 'border-gray-300' }}" required>
        <option value="">Select Company</option>
        @foreach($companies as $company)
            <option value="{{ $company->id }}" {{ old('companyId',$jobVacancy->companyId) == $company->id ? 'selected' : '' }}>
                {{ $company->name }}
            </option>
        @endforeach
    </select>
    @error('companyId')
    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<!-- Job Category select -->
<div class="mb-4">
    <label for="jobCategoryId" class="block text-sm font-medium text-gray-700">Job Category</label>
    <select name="jobCategoryId" id="jobCategoryId"
            class="mt-2 block w-full rounded-md border px-3 py-2
                   {{ $errors->has('jobCategoryId') ? 'border-red-600' : 'border-gray-300' }}" required>
        <option value="">Select Category</option>
        @foreach($jobCategories as $jobCategory)
            <option value="{{ $jobCategory->id }}" {{ old('jobCategoryId',$jobVacancy->jobCategoryId) == $jobCategory->id ? 'selected' : '' }}>
                {{ $jobCategory->name }}
            </option>
        @endforeach
    </select>
    @error('jobCategoryId')
    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

                    <!-- Job Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Job Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="4" 
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                            placeholder="Write a clear description about the role, responsibilities, and expectations..."
                        >{{ old('description',$jobVacancy->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('job-vacancies.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md 
                              hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md 
                                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Job Vacancy
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
