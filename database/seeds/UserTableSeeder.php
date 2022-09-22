<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'email'=>'admin@shop.com',
            'sex'=>'1',
            'address'=>'Hà Nội',
            'description'=>'this is admin',
            'phone'=>'0987654321',
            'password'=>\Illuminate\Support\Facades\Hash::make('123456789')
        ]);
    }
}
