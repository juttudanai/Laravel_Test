<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'email' => "admin@gmail.com",
                'status' => 1,
                'password' => bcrypt('1234')
            ],
            [
                'email' => "user@gmail.com",
                'status' => 0,
                'password' => bcrypt('1234')
            ]
        ];

        foreach ($data as $key => $value) {
            $user = new User();
            $user->email = $value['email'];
            $user->status = $value['status'];
            $user->password = $value['password'];
            $user->save();
        }
    }
}
