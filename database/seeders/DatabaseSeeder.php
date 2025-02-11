<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->withPersonalTeam()->create();

        User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@demo.com',
            'password' => bcrypt('123456'), // password
        ]);

        /// I want every account balance transactions as credit when it's created

        Account::factory(count: 10)->create()->each(function ($account) {
            Transaction::create([
                'account_id' => $account->id,
                'amount' => $account->balance,
                'type' => 'credit',
                'description'=> $account->name . ' account created with initial balance',
            ]);
        });

        // I want every account balance transactions as credit when it's created
        // Create additional transactions and update account balance
        foreach (Account::all() as $account) {
            \App\Models\Transaction::factory(10)->create(['account_id' => $account->id])->each(function ($transaction) use ($account) {
                if ($transaction->type == 'credit') {
                    $account->balance += $transaction->amount;
                } else if ($transaction->type == 'debit') {
                    $account->balance -= $transaction->amount;
                }
                $account->save();
            });
        }
        // \App\Models\Account::factory(10)->create()->each(function ($account) {
            
        // });
    }
}
