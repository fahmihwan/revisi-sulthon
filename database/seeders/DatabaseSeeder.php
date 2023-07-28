<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'nama' => 'sulthon',
            'username' => 'admin',
            'hak_akses' => 'owner',
            'password' => Hash::make('qweqwe123'),
        ]);
        \App\Models\Admin::create([
            'nama' => 'brian',
            'username' => 'karyawan',
            'hak_akses' => 'karyawan',
            'password' => Hash::make('qweqwe123'),
        ]);

        // \App\Models\User::factory(10)->create();
        // \App\Models\Kategori::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
