<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id'=>1,
            'name'=>'Jhon Doe',
            'username'=>'jhondoe',
            'photo'=>'public/assets/user/user1.png',
            'password'=>Hash::make('123456'),
        ]);
    }
}
