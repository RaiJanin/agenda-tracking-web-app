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
        Concern::factory()->count(23)->create();
    }
}
