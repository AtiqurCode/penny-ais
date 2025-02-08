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

        // Account::factory(10)->create()->each(function ($account) {
        //     Transaction::factory(5)->create(['account_id' => $account->id]);
        // });

        \App\Models\Account::factory(10)->create()->each(function ($account) {
            \App\Models\Transaction::factory(10)->create(['account_id' => $account->id]);
        });
    }
}
