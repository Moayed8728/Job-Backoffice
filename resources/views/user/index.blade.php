<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }} {{ request('archived') == 'true' ? 'Archived' : '' }}
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

        <!-- Buttons: Archive Toggle -->
        <div class="flex justify-between items-center mb-4 space-x-4">
            <div>
                @if(request('archived') == 'true')
                    <a href="{{ route('users.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-black text-white rounded-md hover:bg-slate-600 focus:outline-none focus:ring-2">
                        Active Users
                    </a>
                @else
                
                    <a href="{{ route('users.index', ['archived' => 'true']) }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Archived Users
                    </a>
                @endif
            </div>
        </div>

        
        <!-- userss Table -->
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">       
                @forelse ($users as $user)
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            <span>{{ $user->name }}</span>
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            {{ $user->email }}
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm 
            {{ $user->role === 'admin' ? 'text-green-600 font-semibold' : 
            ($user->role === 'company-owner' ? 'text-red-600 font-semibold' : 'text-gray-900') }}">
            {{ $user->role }}
        </td>

        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            @if(request('archived') == 'true')
                <form action="{{ route('users.restore', $user->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="text-green-700 hover:text-green-900">
                        ♻️ Restore
                    </button>
                </form>
            @else
                @if($user->role !== 'admin')
                    <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">✍️ Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900"
                                onclick="return confirm('Are you sure you want to archive this user?');">
                            🗃️ Archive
                        </button>
                    </form>
                @endif
            @endif
        </td>
         </tr>
@empty
    <tr>
        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
            No Users found.
        </td>
    </tr>
@endforelse

            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </div>
</x-app-layout>
