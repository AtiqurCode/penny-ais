<div
  class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
  <x-application-logo class="block h-12 w-auto" />

  <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
    Welcome to your Penny Ais
  </h1>

  <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
    The Accounting Information System (AIS) is designed to streamline and automate financial processes, ensuring
    accuracy, efficiency, and compliance. It manages key operations like bookkeeping, payroll, accounts
    payable/receivable, and financial reporting. With real-time data access and integration capabilities, AIS enhances
    decision-making and transparency, supporting businesses in achieving financial excellence.
  </p>

  <!-- Add buttons for adding a new account and a new transaction -->
  <div class="mb-4 text-right">
    <button onclick="document.getElementById('addAccountModal').style.display='block'"
      class="bg-appColorBlue text-white px-4 py-2 rounded">Add New Account</button>
    <button onclick="document.getElementById('addTransactionModal').style.display='block'"
      class="bg-appColorBlue text-white px-4 py-2 rounded ml-2">Add New Transaction</button>
  </div>

  <!-- Column chart -->
  <div class="w-full h-screen bg-white dark:bg-gray-800 p-4 md:p-6 mt-8">
    <div class="flex items-center justify-center">
      <h1 class="mt-4 text-2xl font-medium text-gray-900 dark:text-white mb-6">
        Penny Ais Transactions Statistics
      </h1>
    </div>
    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
      <div class="flex items-center">
        <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
          <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13.6 16.733c.234.269.548.456.895.534a1.4 1.4 0 0 0 1.75-.762c.172-.615-.446-1.287-1.242-1.481-.796-.194-1.41-.861-1.241-1.481a1.4 1.4 0 0 1 1.75-.762c.343.077.654.26.888.524m-1.358 4.017v.617m0-5.939v.725M4 15v4m3-6v6M6 8.5 10.5 5 14 7.5 18 4m0 0h-3.5M18 4v3m2 8a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
          </svg>
        </div>
        <div>
          <h5 id="total-transactions" class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">3.4k
          </h5>
          <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total Transactions</p>
        </div>
      </div>
      {{-- <div>
        <span
          class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
          <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 13V1m0 0L1 5m4-4 4 4" />
          </svg>
          42.5%
        </span>
      </div> --}}
    </div>

    <div class="grid grid-cols-2">
      <dl class="flex items-center">
        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Total Debit:</dt>
        <dd id="total-debit" class="text-gray-900 text-sm dark:text-white font-semibold">$3,232</dd>
      </dl>
      <dl class="flex items-center justify-end">
        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Total Credit:</dt>
        <dd id="total-credit" class="text-gray-900 text-sm dark:text-white font-semibold">1.2%</dd>
      </dl>
    </div>

    <div id="column-chart" class="h-full">

    </div>
  </div>
</div>

<!-- Add Account Modal -->
<div id="addAccountModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
  <div class="flex items-center justify-center min-h-screen px-4 sm:px-0">
    <!-- Background overlay -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true"></div>

    <!-- Modal -->
    <div
      class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
      <div class="px-6 py-4">
        <!-- Modal Header -->
        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-2">
          <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add New Account</h3>
          <button onclick="document.getElementById('addAccountModal').style.display='none'"
            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Modal Body -->
        <form method="POST" action="{{ route('accounting.createAccount') }}" class="mt-4">
          @csrf
          <!-- Name Field -->
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Account Name</label>
            <input type="text" name="name" id="name"
              class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 sm:text-sm bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              required />
          </div>

          <!-- Type Field -->
          <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
            <select name="type" id="type"
              class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              required>
              <option value="asset">Asset</option>
              <option value="liability">Liability</option>
              <option value="equity">Equity</option>
              <option value="revenue">Revenue</option>
              <option value="expense">Expense</option>
            </select>
          </div>

          <!-- Balance Field -->
          <div class="mb-4">
            <label for="balance" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Balance</label>
            <input type="string" name="balance" id="balance"
              class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 sm:text-sm bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
          </div>

          <!-- Actions -->
          <div class="flex justify-end space-x-3">
            <button type="button" onclick="document.getElementById('addAccountModal').style.display='none'"
              class="px-4 py-2 text-sm text-gray-500 dark:text-gray-300 bg-transparent hover:text-gray-700 dark:hover:text-gray-100 rounded-md">
              Cancel
            </button>
            <button type="submit"
              class="px-4 py-2 text-sm text-white bg-blue-500 hover:bg-blue-600 dark:bg-blue-400 dark:hover:bg-blue-500 rounded-md">
              Add Account
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add Transaction Modal -->
<div id="addTransactionModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
  <div class="flex items-center justify-center min-h-screen px-4 sm:px-0">
    <!-- Background overlay -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true"></div>

    <!-- Modal -->
    <div
      class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full">
      <div class="px-6 py-4">
        <!-- Modal Header -->
        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-2">
          <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add New Transaction</h3>
          <button onclick="document.getElementById('addTransactionModal').style.display='none'"
            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Modal Body -->
        <form method="POST" action="{{ route('accounting.createTransaction') }}" class="mt-4">
          @csrf
          <!-- Account Field -->
          <div class="mb-4">
            <label for="account_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Account</label>
            <select name="account_id" id="account_id"
              class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              required>
              @foreach(\App\Models\Account::orderBy('name', 'asc')->get() as $account)
          <option value="{{ $account->id }}">{{ $account->name }}</option>
        @endforeach
            </select>
          </div>

          <!-- Amount Field -->
          <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
            <input type="number" name="amount" id="amount"
              class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 sm:text-sm bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              required />
          </div>

          <!-- Type Field -->
          <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
            <select name="type" id="type"
              class="border p-2 rounded w-full mb-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
              required>
              <option value="credit">Credit</option>
              <option value="debit">Debit</option>
            </select>
          </div>

          <!-- Description Field -->
          <div class="mb-4">
            <label for="description"
              class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <input type="text" name="description" id="description"
              class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 sm:text-sm bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100" />
          </div>

          <!-- Actions -->
          <div class="flex justify-end space-x-3">
            <button type="button" onclick="document.getElementById('addTransactionModal').style.display='none'"
              class="px-4 py-2 text-sm text-gray-500 dark:text-gray-300 bg-transparent hover:text-gray-700 dark:hover:text-gray-100 rounded-md">
              Cancel
            </button>
            <button type="submit"
              class="px-4 py-2 text-sm text-white bg-blue-500 hover:bg-blue-600 dark:bg-blue-400 dark:hover:bg-blue-500 rounded-md">
              Add Transaction
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $.ajax({
      url: '/transactions/statistics',
      method: 'GET',
      success: function (data) {
        const debitData = data.transactions.map(item => ({ x: item.day, y: item.total_debit }));
        const creditData = data.transactions.map(item => ({ x: item.day, y: item.total_credit }));

        $('#total-transactions').text(data.totalTransactions);
        $('#total-debit').text(`৳${data.totalDebit}`);
        $('#total-credit').text(`৳${data.totalCredit}`);

        const options = {
          colors: ["#1A56DB", "#FDBA8C"],
          series: [
            {
              name: "Total Debit",
              color: "#5046e5",
              data: debitData,
            },
            {
              name: "Total Credit",
              color: "#FF0000",
              data: creditData,
            },
          ],
          chart: {
            type: "bar",
            height: "320px",
            fontFamily: "Inter, sans-serif",
            toolbar: {
              show: false,
            },
          },
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: "70%",
              borderRadiusApplication: "end",
              borderRadius: 8,
            },
          },
          tooltip: {
            shared: true,
            intersect: false,
            style: {
              fontFamily: "Inter, sans-serif",
            },
          },
          states: {
            hover: {
              filter: {
                type: "darken",
                value: 1,
              },
            },
          },
          stroke: {
            show: true,
            width: 0,
            colors: ["transparent"],
          },
          grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
              left: 2,
              right: 2,
              top: -14
            },
          },
          dataLabels: {
            enabled: false,
          },
          legend: {
            show: false,
          },
          xaxis: {
            floating: false,
            labels: {
              show: true,
              style: {
                fontFamily: "Inter, sans-serif",
                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
              }
            },
            axisBorder: {
              show: false,
            },
            axisTicks: {
              show: false,
            },
          },
          yaxis: {
            show: false,
          },
          fill: {
            opacity: 1,
          },
        }

        if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
          const chart = new ApexCharts(document.getElementById("column-chart"), options);
          chart.render();
        }
      }
    });
  });
</script>