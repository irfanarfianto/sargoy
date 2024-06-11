<x-dashboard-layout title="User Management">
    <div class="mt-14">
        <x-breadcrumb.breadcrumb :items="$breadcrumbs" />
    </div>
    <div class="flex flex-wrap items-center justify-between space-y-2 sm:space-x-0">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
        @if ($search)
            <p class="text-gray-500">Menampilkan {{ $users->count() }} dari {{ $users->total() }} pengguna</p>
        @endif
        <div class="flex space-x-2">
            <form action="{{ route('dashboard.users.index') }}" method="GET">
                <div class="relative">
                    <x-input.text type="text" name="search" placeholder="Cari pengguna..." />
                    <x-error.input-error :messages="$errors->get('search')" class="mt-2" />
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>
            {{-- tombol reset --}}
            @if ($search)
                <form action="{{ route('dashboard.users.index') }}" method="GET">
                    <x-button.secondary type="submit">
                        Reset
                    </x-button.secondary>
                </form>
            @endif
        </div>
    </div>
    <div class="mt-6 overflow-x-auto">
        <table class=" w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a
                            href="{{ route('dashboard.users.index', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                            Name
                            @if (request('sort') === 'name')
                                @if (request('direction') === 'asc')
                                    <i class="fa fa-sort-alpha-down"></i>
                                @else
                                    <i class="fa fa-sort-alpha-up"></i>
                                @endif
                            @else
                                <i class="fa fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Role
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($users->isEmpty())
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            Pencarian untuk <strong>'{{ $search }}'</strong> tidak ditemukan.</td>
                    </tr>
                @else
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 whitespace-truncate">
                                @if ($user->hasRole('admin'))
                                    <span class="font-bold">{{ $user->name }}</span>
                                @else
                                    {{ $user->name }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 whitespace-truncate">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->getRoleNames()->implode(', ') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($user->isActive())
                                    <span
                                        class="bg-green-400 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Aktif</span>
                                @else
                                    <span
                                        class="bg-red-400 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Offline</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <!-- Actions -->
                                <x-button.text-icon size="sm" icon='fa-solid fa-pen-to-square'
                                    class=" text-indigo-600" data-modal-target="static-modal-{{ $user->id }}"
                                    data-modal-toggle="static-modal-{{ $user->id }}">
                                    Edit
                                </x-button.text-icon>
                                <x-button.text-icon size="sm" icon='fa-solid fa-trash-can'
                                    class="bg-red-500 text-white"
                                    data-modal-target="static-modal-delete{{ $user->id }}"
                                    data-modal-toggle="static-modal-delete{{ $user->id }}">
                                    Hapus
                                </x-button.text-icon>

                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="flex justify-end mt-3">
        {{ $users->appends(request()->input())->links('vendor.pagination.product') }}
    </div>

    @include('dashboard.users.partials.modal-edit')
    @include('dashboard.users.partials.modal-hapus')

</x-dashboard-layout>
