<?php

use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dokters')->insert([
	        'name'  => 'dr. Tono',
            'status'  => '0',
	        'email' => 'dokter@gmail.com',
	        'password'  => bcrypt('12345678'),
	        'keterangan' => 'telah berpengalaman selama 7 tahun dalam menangani berbagai hewan',
		]);
    }
}
