<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <div class="flex items-center justify-between">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Id:</strong>
                                        {{ $user->id }}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {{ $user->name }}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        {{ $user->email }}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Created Date:</strong>
                                        {{ $user->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('users') }}" class="ml-4 text-sm text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100">Back to Users</a>
                                <button onclick="toggleModal()" class="ml-4 text-sm text-blue-500 dark:text-blue-300 hover:text-blue-700 dark:hover:text-blue-100">Update User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->

        <div id="updateModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen px-4 sm:px-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true"></div>

                <!-- Modal -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
                    <div class="px-6 py-4">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Update User</h3>
                            <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <form action="{{ route('users.update', $user->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('PUT')

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 sm:text-sm bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required />
                            </div>

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 sm:text-sm bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required />
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end space-x-3">
                                <button type="button" onclick="toggleModal()" class="px-4 py-2 text-sm text-gray-500 dark:text-gray-300 bg-transparent hover:text-gray-700 dark:hover:text-gray-100 rounded-md">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 hover:bg-blue-600 dark:bg-blue-400 dark:hover:bg-blue-500 rounded-md">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleModal() {
        const modal = document.getElementById('updateModal');
        modal.classList.toggle('hidden');
    }
</script>
