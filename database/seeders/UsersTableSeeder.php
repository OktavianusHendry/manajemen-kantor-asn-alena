<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('codingmu'), // Ganti dengan password yang diinginkan
                'foto_diri' => null,
                'foto_ktp' => null,
                'id_jabatan' => 1, // Sesuaikan dengan id jabatan yang sesuai
                'id_divisi' => 1, // Sesuaikan dengan id divisi yang sesuai
                'alamat' => 'Jalan Admin No. 1',
                'no_telepon' => '081234567890',
                'tanggal_bergabung' => now(),
                'surat_tugas' => null,
                'role_as' => '1', // Angka 1 untuk admin
                'email_verified_at' => now(), // Jika ingin menyetujui email
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Anda bisa menambahkan admin lain jika diperlukan
        ]);
    }
}
