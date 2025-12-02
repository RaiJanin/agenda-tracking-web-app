<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Agenda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'date' => $this->faker->dateTimeBetween('-45 days', 'now'),
            'created_by' => User::where('role', 'admin')->inRandomOrder()->value('id') ?? User::factory()->create(['role', 'admin'])->id,
            'notes' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'ongoing', 'completed']),
        ];
    }
}
