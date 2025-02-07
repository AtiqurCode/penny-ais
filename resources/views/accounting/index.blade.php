<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Accounting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="mb-4 text-right">
                        <button onclick="document.getElementById('addAccountModal').style.display='block'" class="bg-appColorBlue text-white px-4 py-2 rounded">Add New Account</button>
                        <button onclick="document.getElementById('addTransactionModal').style.display='block'" class="bg-appColorBlue text-white px-4 py-2 rounded ml-2">Add New Transaction</button>
                    </div>
                    <!-- Accounts Table -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-white">All Accounts</h2>
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Balance</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                @foreach($accounts as $account)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $account->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $account->type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ number_format($account->balance, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-4">
                                        <a href="{{ route('accounts.show', $account->id) }}" class="text-primary hover:text-primary">
                                            <svg class="w-6 h-6 text-white-600 dark:text-white-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            </svg>
                                        </a>
                                        <button onclick="toggleUpdateAccountModal('{{ $account->id }}', '{{ $account->name }}', '{{ $account->type }}')" class="text-appColorBlue hover:text-appColorBlue">
                                            <svg class="w-6 h-6 text-appColorBlue dark:text-appColorBlue" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Account Modal -->
    <div id="addAccountModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg w-1/3">
                <span onclick="document.getElementById('addAccountModal').style.display='none'" class="float-right cursor-pointer text-gray-800 dark:text-white">&times;</span>
                <form method="POST" action="{{ route('accounting.createAccount') }}" class="mb-8">
                    @csrf
                    <h2 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Add New Account</h2>
                    <input type="text" name="name" placeholder="Account Name" class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required>
                    <select name="type" class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required>
                        <option value="asset">Asset</option>
                        <option value="liability">Liability</option>
                        <option value="equity">Equity</option>
                        <option value="revenue">Revenue</option>
                        <option value="expense">Expense</option>
                    </select>
                    <input type="string" name="balance" placeholder="Balance" class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:bg-blue-400 dark:hover:bg-blue-500">Add Account</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div id="addTransactionModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg w-1/3">
                <span onclick="document.getElementById('addTransactionModal').style.display='none'" class="float-right cursor-pointer text-gray-800 dark:text-white">&times;</span>
                <form method="POST" action="{{ route('accounting.createTransaction') }}">
                    @csrf
                    <h2 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Add New Transaction</h2>
                    <select name="account_id" class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required>
                        @foreach($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="amount" placeholder="Amount" class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required>
                    <select name="type" class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required>
                        <option value="credit">Credit</option>
                        <option value="debit">Debit</option>
                    </select>
                    <input type="text" name="description" placeholder="Description" class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:bg-blue-400 dark:hover:bg-blue-500">Add Transaction</button>
                </form>
            </div>
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
