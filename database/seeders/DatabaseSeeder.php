<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
     $role_user =  Role::create([
           'name' => 'Пользователь',
           'code' => 'user',
       ]);
     $role_admin = Role::create([
           'name' => 'Администратор',
           'code' => 'admin',
       ]);
        User::create([
            'surname' => 'Мотов',
            'name' => 'Алибола',
            'patronymic' => 'Эльманович',
            'sex' => 1,
            'birthday' => '1005-01-27',
            'login' => 'noway',
            'email' => 'alibola123@mail.com',
            'password' => 'noway',
            'api_token' => null,
            'role_id' => $role_user->id,
       ]);
        User::create([
            'surname' => 'Евсеев',
            'name' => 'Дмитрий',
            'patronymic' => 'Витальевич',
            'sex' => 1,
            'birthday' => '1005-11-04',
            'login' => 'krofpoi',
            'email' => 'dima123@mail.com',
            'password' => 'krofpoi',
            'api_token' => null,
            'role_id' => $role_admin->id,
        ]);
    }
}
