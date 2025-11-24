<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Concern;
use App\Models\Agenda;
use App\Models\User;
use Carbon\Carbon;

class ConcernSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereIn('role', ['member', 'it'])->get();

        if ($users->isEmpty()) {
            $this->command->warn('No users with role "member" or "it" found. Please seed users first.');
            return;
        }

        $agendas = Agenda::all();

        if ($agendas->isEmpty()) {
            $this->command->warn('No agendas found. Please seed agendas first.');
            return;
        }

        foreach ($agendas as $agenda) {
            foreach (range(1, 3) as $i) {
                $user = $users->random();

                Concern::create([
                    'agenda_id' => $agenda->agenda_id,
                    'description' => "Concern #{$i} for {$agenda->title}",
                    'responsible_person_id' => $user->id,
                    'status' => ['pending', 'ongoing', 'completed'][array_rand(['pending', 'ongoing', 'completed'])],
                    'due_date' => Carbon::now()->addDays(rand(1, 15)),
                ]);
            }
        }
    }
}
