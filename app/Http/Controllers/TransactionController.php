<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function getTransactions()
    {
        $transactions = Transaction::with('account')->latest()->paginate(15);

        return view('transactions.index', compact('transactions'));
    }

    public function index()
    {
        $transactions = Transaction::selectRaw('DATE_FORMAT(created_at, "%d") as day, 
                                                SUM(CASE WHEN type = "debit" THEN amount ELSE 0 END) as total_debit, 
                                                SUM(CASE WHEN type = "credit" THEN amount ELSE 0 END) as total_credit')
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $totalTransactions = Transaction::count();
        $totalDebit = Transaction::where('type', 'debit')->sum('amount');
        $totalCredit = Transaction::where('type', 'credit')->sum('amount');

        return response()->json([
            'transactions' => $transactions,
            'totalTransactions' => $totalTransactions,
            'totalDebit' => $totalDebit,
            'totalCredit' => $totalCredit,
        ]);
    }
}
