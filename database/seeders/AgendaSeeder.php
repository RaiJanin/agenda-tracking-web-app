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

        // Create 16 sample agendas
        Agenda::factory()
            ->count(16)
            ->hasConcerns(3)
            ->state(['created_by' => $admin->id])
            ->create();
    }
}