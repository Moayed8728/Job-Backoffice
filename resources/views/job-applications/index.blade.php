<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('job-applications') }} {{ request('archived') == 'true' ? 'Archived' : '' }}
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
                    <a href="{{ route('job-applications.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-black text-white rounded-md hover:bg-slate-600 focus:outline-none focus:ring-2">
                        Active Job Applications
                    </a>
                @else
                    <a href="{{ route('job-applications.index', ['archived' => 'true']) }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Archived Job Applications
                    </a>
                @endif
            </div>
        
        </div>

        <!-- Company Table -->
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applicant Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Position</th>
                    @if(auth()->user()->role == 'admin')
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                    @endif
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th> 
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($jobApplications as $jobApplication)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                        @if (request()->input('archived') == 'true')
                        <span class="text-gray-500 line-through">{{ $jobApplication->user->name }}</span>
                        @else
                        <a class="text-blue-500 hover:text-blue-700 underline" href="{{ route('job-applications.show', $jobApplication->id) }}">
                        {{ $jobApplication->user?->name ?? 'Unknown user' }}
                    </a>
                    @endif

                    </td>
                        
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $jobApplication->jobVacancy->title }}
                        </td>


                        @if(auth()->user()->role == 'admin')
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ $jobApplication->jobVacancy?->company?->name ?? 'N/A' }}
                            </td>
                        @endif


                        <td class="px-6 py-4 whitespace-nowrap text-sm 
                        
                        {{ $jobApplication->status === 'Accepted' ? 'text-green-600 font-semibold' : 
                        ($jobApplication->status === 'Rejected' ? 'text-red-600 font-semibold' : 'text-gray-900') }}">
                        {{ $jobApplication->status }}
                    
                    </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                            @if(request('archived') == 'true')
                                <!-- Restore Button -->
                                <form action="{{ route('job-applications.restore', $jobApplication->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-700 hover:text-green-900">
                                        ♻️ Restore
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('job-applications.edit', $jobApplication->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">✍️ Edit</a>
                                
                                <form action="{{ route('job-applications.destroy', $jobApplication->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Are you sure you want to archive this application?');">
                                        🗃️ Archive
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No Job Applications found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $jobApplications->links() }}
        </div>

    </div>
</x-app-layout>
