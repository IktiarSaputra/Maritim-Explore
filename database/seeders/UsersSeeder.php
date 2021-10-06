<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Iktiar',
               'email'=>'iktiar@maritim.com',
               'phone_number' => '081319304342',
               'address' => 'Jatinegara',
               'level'=>'admin',
               'password'=> Hash::make('secret123'),
            ],
            [
               'name'=>'Rizki',
               'email'=>'rizki@maritim.com',
               'phone_number' => '081319304342',
               'address' => 'Tebet',
               'level'=>'owner',
               'password'=> Hash::make('secret123'),
            ],
            [
                'name'=>'Dewa',
                'email'=>'gibran1336@gmail.com',
                'phone_number' => '081319304342',
                'address' => 'Tebet',
                'level'=>'seller',
                'password'=> Hash::make('secret123'),
             ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
