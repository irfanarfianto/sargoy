@foreach ($users as $user)
    <div id="static-modal-{{ $user->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class=" relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit User
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="static-modal-{{ $user->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <!-- Form untuk edit user -->
                    <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Input fields -->
                        <div>
                            <x-label.input for="name"
                                class="block text-sm font-medium text-gray-700">Name:</x-label.input>
                            <x-input.text type="text" id="name" name="name" value="{{ $user->name }}"
                                disabled />
                        </div>
                        <div class="mt-4">
                            <x-label.input for="email"
                                class="block text-sm font-medium text-gray-700">Email:</x-label.input>
                            <x-input.text type="email" id="email" name="email" value="{{ $user->email }}"
                                disabled />
                        </div>
                        <div class="mt-4">
                            <x-label.input for="roles" class="...">Roles:</x-label.input>
                            <!-- Roles dropdown -->
                            <select id="roles" name="roles[]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <!-- Submit button -->
                        <div class="mt-4">
                            <x-button.primary>
                                Simpan
                            </x-button.primary>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
