<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       Role::create([
           'name' => 'Пользователь',
           'code' => 'user',
       ]);
        Role::create([
           'name' => 'Администратор',
           'code' => 'admin',
       ]);

    }
}
