<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'id'=>1,
            'name'=>'Gennie girl',
            'username'=>'gennie',
            'photo'=>'public/assets/user/user1.png',
            'password'=>Hash::make('123456'),
        ]);
    }
}
