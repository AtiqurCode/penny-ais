<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getTransactions()
    {
        $transactions = Transaction::latest()->get();

        return view('transactions.index', compact('transactions'));
    }
}
