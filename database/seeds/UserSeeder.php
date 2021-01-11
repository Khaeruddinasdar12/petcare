<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
	        'name'  => 'Khaeruddin Asdar',
	        'email' => 'khaeruddinasdar12@gmail.com',
	        'password'  => bcrypt('12345678'),
            'nohp' => '082344949500'
		]);

        DB::table('users')->insert([
            'name'  => 'Widya UIN',
            'email' => 'widya@gmail.com',
            'password'  => bcrypt('12345678'),
            'nohp' => '082390009999'
        ]);
    }
}
