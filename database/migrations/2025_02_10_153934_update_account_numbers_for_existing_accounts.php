<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Account;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Make sure to load the model if it's not autoloaded in migrations.
        Account::whereNull('account_number')->orWhere('account_number', '')->chunk(100, function ($accounts) {
            foreach ($accounts as $account) {
                $account->account_number = 'PAIS-' . strtoupper(Str::random(10));
                $account->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optionally, you can decide what should happen when rolling back.
        // For example, you might want to set the account_number to NULL.
        Account::query()->update(['account_number' => null]);
    }
};
