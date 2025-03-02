<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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

        try {
            $account = Account::create($request->all());
            $transaction = new Transaction();
            $transaction->description = $request->name . ' account created';
            $transaction->type = 'credit';
            $transaction->amount = $request->balance;
            $transaction->account_id = $account->id;
            $transaction->save();
        } catch (\Exception $e) {
            return redirect()->route('accounting.index')->with('error', 'Account creation failed.');
        }
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

        DB::beginTransaction();
        try {
            $transaction = Transaction::create($request->all());

            // Update account balance
            $account = $transaction->account;
            if ($transaction->type == 'credit') {
                $account->balance += $transaction->amount;
            } else {
                $account->balance -= $transaction->amount;
            }
            $account->save();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('accounting.index')->with('error', 'Transaction creation failed.');
        }
            
        

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
        return $pdf->stream($account->name.'-transactions-' . date('Y-m-d') . '.pdf');
    }

}
