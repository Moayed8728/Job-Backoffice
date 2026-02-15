<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <a href="{{ route('users.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                ⬅️ Back  
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit User') }}
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
                User Details
            </h3>

            <form method="POST" 
                  action="{{ route('users.update', ['user' => $user->id, 'redirectToList' => request()->query('redirectToList')]) }}" 
                  class="space-y-6">

                @csrf
                @method('PUT')

                <!-- Applicant Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">User Name</label>
                    <span>{{ $user->name ?? 'N/A' }}</span>
                </div>

                <!-- Job Vacancy -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">User Email</label>
                    <span>{{ $user->email }}</span>
                </div>

                <!-- User Role -->
                <div class="mb-4">  
                    <label class="block text-sm font-medium text-gray-700">User Role</label>
                    <span>{{ $user->role }}</span>
                </div>

                <div class="mb-4 relative" x-data="{ show: false }">
                    <label for="user_password" class="block text-sm font-medium text-gray-700">Change User Password</label>
                    
                    <input :type="show ? 'text' : 'password'" 
                           name="user_password" 
                           id="user_password"
                           class="mt-2 block w-full rounded-md border px-3 py-2 pr-10
                                  {{ $errors->has('user_password') ? 'border-red-600' : 'border-gray-300' }}"
                           placeholder="Enter Password" 
                           autocomplete="new-password">
                
                    <!-- Eye Icon -->
                    <button type="button" 
                            @click="show = !show" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                           </svg>
                        </button>
                
                    @error('user_password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Form Buttons -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('users.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md 
                              hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md 
                                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
