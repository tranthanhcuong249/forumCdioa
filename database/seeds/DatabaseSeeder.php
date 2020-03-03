<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <=10; $i++){
            DB::table('users')->insert([
                'name' => 'Nguoi dung ' .$i,
                'email' => 'email'.$i.'@gmail.com',
                'password' => bcrypt('admin'),
                'phone'=> "0905".rand(000000,666666),
                'role' => '0',
            ]);
        }
    }
}
