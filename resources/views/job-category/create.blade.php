<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Job Category') }}
            </h2>
            <a href="{{ route('job-categories.index') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 
                      focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 border-b pb-3">
                Create New Category
            </h3>

            <form method="POST" action="{{ route('job-categories.store') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="{{ $errors->has('name')?'outline-red-600' : 'outline-gray-300' }} outline outline-1 mt-2 block w-full rounded-md border-gray-300 shadow-sm 
                                  focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                           placeholder="Enter category name" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p
                    @enderror
                </div>
                

                <div class="flex justify-end">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md 
                                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Category
                    </button>

                     <!--add cancel button-->
                    <div class="ml-4">
                        <a href="{{ route('job-categories.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md 
                                  hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Cancel
                        </a>
                </div>
            
                
                   </form>
                   
        </div>
    </div>
</x-app-layout>
