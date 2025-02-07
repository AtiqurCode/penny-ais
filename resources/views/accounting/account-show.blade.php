<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100 mb-12">
                    <div class="mb-4">
                        <div class="flex items-center justify-between">
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {{ $account->name }}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Type:</strong>
                                        {{ $account->type }}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Balance:</strong>
                                        {{ $account->balance }}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Created:</strong>
                                        {{ $account->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('accounting.index') }}" class="ml-4 text-sm text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100">Back to Accounting</a>
                                <button onclick="toggleUpdateAccountModal('{{ $account->id }}', '{{ $account->name }}', '{{ $account->type }}')" class="ml-4 text-sm text-blue-500 dark:text-blue-300 hover:text-blue-700 dark:hover:text-blue-100">Update Account</button>
                            </div>
                        </div>
                    </div>
                </div>


            <!-- Transactions Table -->
            @if($account->transactions->isEmpty())
                <p class=" text-xl text-gray-500 dark:text-gray-300">There are no transactions for this user.</p>
            @else
                <!-- Transactions Table -->
                <div class="mb-12">
                <h2 class="text-2xl mb-4 text-gray-800 dark:text-white"> <span class="font-semibold">{{ $account->name }}</span> transactions</h2>
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-x font-semibold text-gray-500 dark:text-gray-300  tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-x font-semibold text-gray-500 dark:text-gray-300  tracking-wider">Transaction Date</th>
                                <th class="px-6 py-3 text-left text-x font-semibold text-gray-500 dark:text-gray-300  tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-x font-semibold text-gray-500 dark:text-gray-300  tracking-wider">Amount</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach($account->transactions as $transaction)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transaction->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transaction->created_at->format('h:i A d M, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transaction->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ number_format($transaction->amount, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            </div>
        </div>


        <!-- Update Account Modal -->
        <div id="updateAccountModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen px-4 sm:px-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true"></div>

                <!-- Modal -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
                    <div class="px-6 py-4">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Update Account</h3>
                            <button onclick="toggleUpdateAccountModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <form id="updateAccountForm" action="" method="POST" class="mt-4">
                            @csrf
                            @method('PUT')

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="account_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="account_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 sm:text-sm bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required />
                            </div>

                            <!-- Type Field -->
                            <div class="mb-4">
                                <label for="account_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                                <select name="type" id="account_type" class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required>

                                    <option value="asset">Asset</option>
                                    <option value="liability">Liability</option>
                                    <option value="equity">Equity</option>
                                    <option value="revenue">Revenue</option>
                                    <option value="expense">Expense</option>
                                </select>
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end space-x-3">
                                <button type="button" onclick="toggleUpdateAccountModal()" class="px-4 py-2 text-sm text-gray-500 dark:text-gray-300 bg-transparent hover:text-gray-700 dark:hover:text-gray-100 rounded-md">
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
    function toggleUpdateAccountModal(id = null, name = null, type = null) {
        const modal = document.getElementById('updateAccountModal');
        const form = document.getElementById('updateAccountForm');
        const nameInput = document.getElementById('account_name');
        const typeInput = document.getElementById('account_type');

        if (id && name && type) {
            form.action = `/accounting/${id}`;
            nameInput.value = name;
            typeInput.value = type;
        }

        modal.classList.toggle('hidden');
    }
</script>
