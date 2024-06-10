<x-dashboard-layout title="User Management">
    <h2 class="font-semibold mt-14 text-xl text-gray-800 leading-tight">
        {{ __('User Management') }}
    </h2>

    <div class="mt-6">
        <table class=" w-full min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
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
                @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if ($user->hasRole('admin'))
                                <span class="font-bold">{{ $user->name }}</span>
                            @else
                                {{ $user->name }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->getRoleNames()->implode(', ') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if ($user->isActive())
                                <span class="text-green-500">Aktif</span>
                            @else
                                <span class="text-red-500">Offline</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <!-- Actions -->
                            <x-button.text-icon size="sm" icon='fa-solid fa-pen-to-square' class=" text-indigo-600"
                                data-modal-target="static-modal-{{ $user->id }}"
                                data-modal-toggle="static-modal-{{ $user->id }}">
                                Edit
                            </x-button.text-icon>
                            <x-button.text-icon size="sm" icon='fa-solid fa-trash-can'
                                class="bg-red-500 text-white" data-modal-target="static-modal-delete{{ $user->id }}"
                                data-modal-toggle="static-modal-delete{{ $user->id }}">
                                Hapus
                            </x-button.text-icon>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>

    @include('dashboard.users.partials.modal-edit')
    @include('dashboard.users.partials.modal-hapus')

</x-dashboard-layout>
