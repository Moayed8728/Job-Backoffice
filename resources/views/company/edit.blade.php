@php
if(auth()->user()->role == 'admin'){
$formAction = route('companies.update',['company' => $company->id, 'redirectToList' => request('redirectToList')]);
} elseif(auth()->user()->role == 'company-owner'){
    $formAction = route('my-company.update');
    }
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <a href="{{ route('companies.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                ⬅️ Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Company') . ' - ' . $company->name }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 border-b pb-3">
                Edit Company
            </h3>

            <form method="POST" action="{{ $formAction }}" class="space-y-6">
            @csrf
            @method('PUT')
                <!-- Company Details -->
                <div class="mb-4 p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold mb-2">Company Details</h3>

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Company Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}"
                               class="mt-2 block w-full rounded-md border px-3 py-2
                                      {{ $errors->has('name') ? 'border-red-600' : 'border-gray-300' }}"
                               placeholder="Enter company name" required>
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $company->address) }}"
                               class="mt-2 block w-full rounded-md border px-3 py-2
                                      {{ $errors->has('address') ? 'border-red-600' : 'border-gray-300' }}"
                               placeholder="Enter Address" required>
                        @error('address')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="website" class="block text-sm font-medium text-gray-700">Company Website</label>
                        <input type="text" name="website" id="website" value="{{ old('website', $company->website) }}"
                               class="mt-2 block w-full rounded-md border px-3 py-2
                                      {{ $errors->has('website') ? 'border-red-600' : 'border-gray-300' }}"
                               placeholder="Enter Website Name">
                        @error('website')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                        <select name="industry" id="industry"
                                class="mt-2 block w-full rounded-md border px-3 py-2
                                       {{ $errors->has('industry') ? 'border-red-600' : 'border-gray-300' }}" required>
                            <option value="">Select Industry</option>
                            @foreach ($industries as $industry)
                                <option value="{{ $industry }}" {{ old('industry', $company->industry) == $industry ? 'selected' : '' }}>
                                    {{ $industry }}
                                </option>
                            @endforeach
                        </select>
                        @error('industry')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Company Owner Details -->
                <div class="mb-4 p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm" x-data="{ show: false }">
                    <h3 class="text-lg font-bold mb-2">Company Owner</h3>
                    <p class="text-sm mb-2">Enter the company owner details</p>

                    <div class="mb-4">
                        <label for="owner_name" class="block text-sm font-medium text-gray-700">Owner Name</label>
                        <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name', $company->owner->name) }}"
                               class="mt-2 block w-full rounded-md border px-3 py-2
                                      {{ $errors->has('owner_name') ? 'border-red-600' : 'border-gray-300' }}"
                               placeholder="Enter Owner Name" required>
                        @error('owner_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="owner_email" class="block text-sm font-medium text-gray-700">Owner Email</label>
                        <input disabled type="email" name="owner_email" id="owner_email" value="{{ old('owner_email', $company->owner->email) }}"
                               class="mt-2 block w-full rounded-md border px-3 py-2 bg-gray-100
                                      {{ $errors->has('owner_email') ? 'border-red-600' : 'border-gray-300' }}"
                               placeholder="Enter Owner Email" required>
                        @error('owner_email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 relative">
                        <label for="owner_password" class="block text-sm font-medium text-gray-700">Change Owner Password (Leave Blank To Keep The Same)</label>
                        <input :type="show ? 'text' : 'password'" name="owner_password" id="owner_password"
                               class="mt-2 block w-full rounded-md border px-3 py-2 pr-10
                                      {{ $errors->has('owner_password') ? 'border-red-600' : 'border-gray-300' }}"
                               placeholder="Enter Password"  autocomplete="new-password">
                        @error('owner_password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <button type="button" class="absolute top-1/2 right-2 -translate-y-1/2 text-gray-500"
                                @click="show = !show" tabindex="-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" 
                                 stroke="currentColor">
                                <path x-show="!show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path x-show="show" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3l18 18M13.875 18.825A9.56 9.56 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.563 9.563 0 011.042-2.556" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md 
                                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Company
                    </button>

                    @if (auth()->user()->role == 'company-owner')
                    <a href="{{ route('my-company.show') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md 
                              hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </a>
                    @endif

                    @if (auth()->user()->role == 'admin')
                    <a href="{{ route('companies.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md 
                              hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
