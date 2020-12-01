<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
	        'name'  => 'Admin Ilyas',
	        'email' => 'admin@gmail.com',
	        'password'  => bcrypt('12345678')
		]);
    }
}
