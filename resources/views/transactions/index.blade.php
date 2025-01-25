<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="mb-4 text-right">
                        <button onclick="document.getElementById('addTransactionModal').style.display='block'" class="bg-appColorBlue text-white px-4 py-2 rounded ml-2">New Transaction</button>
                    </div>
                    <!-- Transactions Table -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-white">All Transactions</h2>
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                @foreach($transactions as $transaction)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transaction->type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ number_format($transaction->amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transaction->description }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Transaction Modal -->
    {{-- <div id="addTransactionModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
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
    </div> --}}

</x-app-layout>
