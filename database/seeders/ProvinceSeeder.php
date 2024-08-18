<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = array(
			array('code' => 'AC', 'name' => 'Nanggroe Aceh Darussalam'),
			array('code' => 'SU', 'name' => 'Sumatera Utara'),
			array('code' => 'SS', 'name' => 'Sumatera Selatan'),
			array('code' => 'SB', 'name' => 'Sumatera Barat'),
			array('code' => 'BE', 'name' => 'Bengkulu'),
			array('code' => 'RI', 'name' => 'Riau'),
			array('code' => 'KR', 'name' => 'Kepulauan Riau'),
			array('code' => 'JA', 'name' => 'Jambi'),
			array('code' => 'LA', 'name' => 'Lampung'),
			array('code' => 'BB', 'name' => 'Bangka Belitung'),
			array('code' => 'KB', 'name' => 'Kalimantan Barat'),
			array('code' => 'KT', 'name' => 'Kalimantan Timur'),
			array('code' => 'KS', 'name' => 'Kalimantan Selatan'),
			array('code' => 'KH', 'name' => 'Kalimantan Tengah'),
			array('code' => 'KU', 'name' => 'Kalimantan Utara'),
			array('code' => 'BT', 'name' => 'Banten'),
			array('code' => 'JK', 'name' => 'DKI Jakarta'),
			array('code' => 'JB', 'name' => 'Jawa Barat'),
			array('code' => 'JT', 'name' => 'Jawa Tengah'),
			array('code' => 'DIY', 'name' => 'Daerah Istimewa Yogyakarta'),
			array('code' => 'JI', 'name' => 'Jawa Timur'),
			array('code' => 'BA', 'name' => 'Bali'),
			array('code' => 'NTT', 'name' => 'Nusa Tenggara Timur'),
			array('code' => 'NTB', 'name' => 'Nusa Tenggara Barat'),
			array('code' => 'GO', 'name' => 'Gorontalo'),
			array('code' => 'SB', 'name' => 'Sulawesi Barat'),
			array('code' => 'ST', 'name' => 'Sulawesi Tengah'),
			array('code' => 'SU', 'name' => 'Sulawesi Utara'),
			array('code' => 'SG', 'name' => 'Sulawesi Tenggara'),
			array('code' => 'SS', 'name' => 'Sulawesi Selatan'),
			array('code' => 'MU', 'name' => 'Maluku Utara'),
			array('code' => 'MA', 'name' => 'Maluku'),
			array('code' => 'PB', 'name' => 'Papua Barat'),
			array('code' => 'PA', 'name' => 'Papua'),
			array('code' => 'PT', 'name' => 'Papua Tengah'),
			array('code' => 'PP', 'name' => 'Papua Pegunungan'),
			array('code' => 'PS', 'name' => 'Papua Selatan'),
			array('code' => 'PBD', 'name' => 'Papua Barat Daya'),
		);

		DB::table('provinces')->insert($provinces);
    }
}