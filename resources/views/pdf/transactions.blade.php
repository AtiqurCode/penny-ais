<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Account Transactions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f6f6f6;
            font-weight: "regular" !important;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px
        }

        /* Center align the h2 element */
    </style>
</head>

<body>
    <h1 style="color: #5046e5;">Penny Ais</h1>
    <p><span style="color: dark; font-weight: bold">{{ $data['account']->name }}</span> Account Transactions</h4>
        @if($data['account']->transactions->isEmpty())
            <p>There are no transactions for this user.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Transaction Date</th>
                        <th>Debit</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalDebit = 0;
                        $totalCredit = 0;
                    @endphp
                    @foreach($data['account']->transactions as $transaction)
                        <tr>
                            <td>
                                @if (empty($transaction->description))
                                    {{"N/A"}}
                                @else
                                    {{$transaction->description}}
                                @endif
                            </td>
                            <td>{{ $transaction->created_at->format('d M, Y') }}</td>
                            <td>
                                @if ($transaction->type == 'debit')
                                    @php $totalDebit += $transaction->amount; @endphp
                                    {{ number_format($transaction->amount, 2) }}
                                @else
                                    {{ '-' }}
                                @endif
                            </td>
                            <td>
                                @if ($transaction->type == 'credit')
                                    @php $totalCredit += $transaction->amount; @endphp
                                    {{ number_format($transaction->amount, 2) }}
                                @else
                                    {{ '-' }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th>{{ number_format($totalDebit, 2) }}</th>
                        <th>{{ number_format($totalCredit, 2) }}</th>
                    </tr>
                    <tr>
                        <th colspan="2">Closing Balance</th>
                        <th></th>
                        <th>{{ number_format($totalDebit - $totalCredit, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        @endif
</body>

</html>