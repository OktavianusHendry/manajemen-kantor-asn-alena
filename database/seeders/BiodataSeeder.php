<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Biodata;

class BiodataSeeder extends Seeder
{
    public function run()
    {
        $users = User::all(); // Ambil semua user yang sudah ada

        foreach ($users as $user) {
            // Cek apakah user sudah punya biodata
            if (!$user->biodata) {
                Biodata::create([
                    'id_user' => $user->id,
                    'tanggal_bergabung' => now(), // Atur default atau NULL sesuai kebutuhan
                ]);
            }
        }

        $this->command->info('Biodata generated for existing users.');
    }
}

