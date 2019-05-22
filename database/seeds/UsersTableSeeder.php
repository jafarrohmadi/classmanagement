<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d G:i:s');
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'remember_token' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create([
            'name' => 'know',
            'email' => 'know@gmail.com',
            'password' => Hash::make('know123'),
            'remember_token' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
    }

}
