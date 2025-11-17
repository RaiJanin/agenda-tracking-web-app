<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;
use App\Models\User;
use Carbon\Carbon;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Create 3 sample agendas
        $agendas = [
            [
                'title' => 'Monthly IT Meeting',
                'date' => Carbon::now()->subDays(5),
                'created_by' => $admin ? $admin->id : 1,
                'notes' => 'Discussed upcoming network upgrades and project timelines.',
                
                'status' => 'completed',
            ],
            [
                'title' => 'System Maintenance Review',
                'date' => Carbon::now()->subDays(2),
                'created_by' => $admin ? $admin->id : 1,
                'notes' => 'Evaluated performance of the Mineral system and identified bottlenecks.',
                
                'status' => 'ongoing',
            ],
            [
                'title' => 'New Feature Planning',
                'date' => Carbon::now(),
                'created_by' => $admin ? $admin->id : 1,
                'notes' => 'Planned updates for inventory and reporting features.',
                
                'status' => 'pending',
            ],
        ];

        foreach ($agendas as $data) {
            Agenda::create($data);
        }
    }
}