<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory;

    protected $fillable = ['name', 'type', 'balance', 'account_number'];

    protected static function boot()
    {
        parent::boot();

        // Before creating a new Account, generate a random account number.
        static::creating(function ($account) {
            $account->account_number = 'PAIS-' . strtoupper(Str::random(10));
        });
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


}
