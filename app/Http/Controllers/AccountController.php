<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::latest()->get();
        return view('accounting.index', compact('accounts'));
    }

    public function createAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:asset,liability,equity,revenue,expense',
        ]);

        Account::create($request->all());
        return redirect()->route('accounting.index')->with('success', 'Account created successfully.');
    }

    public function createTransaction(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric',
            'type' => 'required|in:credit,debit',
            'description' => 'nullable|string',
        ]);

        $transaction = Transaction::create($request->all());

        // Update account balance
        $account = $transaction->account;
        if ($transaction->type == 'credit') {
            $account->balance += $transaction->amount;
        } else {
            $account->balance -= $transaction->amount;
        }
        $account->save();

        return redirect()->route('accounting.index')->with('success', 'Transaction added successfully.');
    }

    public function show($id)
    {
        $account = Account::with('transactions')->findOrFail($id);
        return view('accounting.account-show', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        $account->update($request->all());
        return redirect()->route('accounting.index');
    }

    public function generatePDF($id)
    {

        $account = Account::findOrFail($id);
        // Fetch all transactions
        $transactions = Transaction::where('account_id', $id)
                ->latest()->get();

        $data = [
            'account' => $account,
            'transactions' => $transactions,
        ];

        // Load PDF view with data
        $pdf = Pdf::loadView('pdf.transactions', compact('data'));

        // Download as a PDF file
        return $pdf->stream('transactions.pdf');
    }

}
