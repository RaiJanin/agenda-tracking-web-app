<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\Concern;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Concern>
 */
class ConcernFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Concern::class;

    public function definition(): array
    {
        return [
            'agenda_id' => Agenda::inRandomOrder()->value('agenda_id') ?? Agenda::factory(),
            'responsible_person_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'description' => $this->faker->sentence(12),
            'status' => $this->faker->randomElement([ 'pending', 'ongoing', 'resolved', 'closed', 'completed' ]),
            'due_date' => $this->faker->optional()->dateTimeBetween('now', '+30 days'),
        ];
    }

    /**
     * State: archived concern
     */
    public function archived()
    {
        return $this->state(fn () => [
            'archived_at' => now(),
        ]);
    }
}
