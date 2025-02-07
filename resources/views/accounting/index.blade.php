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
                                        <a href="" class="text-primary hover:text-primary">
                                            <svg class="w-6 h-6 text-white-600 dark:text-white-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            </svg>
                                        </a>
                                        <button onclick="" class="text-appColorBlue hover:text-appColorBlue">
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
                    <input type="text" name="name" placeholder="Account Name" class="border p-2 rounded w-full mb-2" required>
                    <select name="type" class="border p-2 rounded w-full mb-2" required>
                        <option value="asset">Asset</option>
                        <option value="liability">Liability</option>
                        <option value="equity">Equity</option>
                        <option value="revenue">Revenue</option>
                        <option value="expense">Expense</option>
                    </select>
                    <input type="string" name="balance" placeholder="Balance" class="border p-2 rounded w-full mb-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Account</button>
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
                    <select name="account_id" class="border p-2 rounded w-full mb-2" required>
                        @foreach($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="amount" placeholder="Amount" class="border p-2 rounded w-full mb-2" required>
                    <select name="type" class="border p-2 rounded w-full mb-2" required>
                        <option value="credit">Credit</option>
                        <option value="debit">Debit</option>
                    </select>
                    <input type="text" name="description" placeholder="Description" class="border p-2 rounded w-full mb-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Transaction</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
