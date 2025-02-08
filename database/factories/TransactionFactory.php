<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::factory(), // Creates an account for the transaction
            'amount' => $this->faker->randomFloat(2, 1, 5000),
            'type' => $this->faker->randomElement(['credit', 'debit']),
            'description' => $this->faker->sentence,
            'created_at' => $this->faker->dateTimeBetween('-1 week', '+1 month'),
        ];
    }
}
