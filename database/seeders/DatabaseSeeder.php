<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        // User::factory(10)->create();

        $clinic = Clinic::factory()->create([
            'name' => 'Test Clinic',
            'email' => 'capilar@capilar.es',
            'phone' => '666666666',
            'plan' => 'free',
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'nif' => 'X5165038C',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'clinic_id' => $clinic->id,
        ]);

        $specialist = User::factory()->create([
            'name' => 'Specialist User',
            'email' => 'specialist@example.com',
            'nif' => '60100771T',
            'password' => bcrypt('admin123'),
            'role' => 'specialist',
            'clinic_id' => $clinic->id,
        ]);

        $service = Service::factory()->create([
            'name' => 'Mesoterapia',
            'clinic_id' => $clinic->id,
            'price' => 100,
            'duration_minutes' => 60,
        ]);

    }
}
