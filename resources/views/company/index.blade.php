<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('companies') }} {{ request('archived') == 'true' ? 'Archived' : '' }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">

        <!-- Pop Up Notification -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition
                 x-init="setTimeout(() => show = false, 5000)"
                 class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Buttons: Archive Toggle + Add company -->
        <div class="flex justify-between items-center mb-4 space-x-4">

            <!-- Active / Archived Toggle -->
            <div>
                @if(request('archived') == 'true')
                    <a href="{{ route('companies.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-black text-white rounded-md hover:bg-slate-600 focus:outline-none focus:ring-2">
                        Active companies
                    </a>
                @else
                    <a href="{{ route('companies.index', ['archived' => 'true']) }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Archived companies
                    </a>
                @endif
            </div>

            <!-- Add Job company (hide when archived) -->
            @if(request('archived') != 'true')
                <div>
                    <a href="{{ route('companies.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Companies
                    </a>
                </div>
            @endif

        </div>

        <!-- Company Table -->
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Website</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Industry</th> 
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($companies as $company)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                          @if (request()->input('archived') == 'true')
                          <span class="text-gray-500 line-through">{{ $company->name }}</span>
                          @else
                          <a class="text-blue-500 hover:text-blue-700 underline" href="{{ route('companies.show', $company->id) }}">
                          {{ $company->name }}
                        </a>
                        @endif
                        </td>
                        
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $company->address }}
                        </td>

                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $company->website }}
                        </td>

                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $company->industry }}
                        </td>

                        

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                            @if(request('archived') == 'true')
                                <!-- Restore Button -->
                                <form action="{{ route('companies.restore', $company->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-700 hover:text-green-900">
                                        ♻️ Restore
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('companies.edit', $company->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">✍️ Edit</a>
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Are you sure you want to archive this company?');">
                                        🗃️ Archive
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No companies found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $companies->links() }}
        </div>

    </div>
</x-app-layout>
