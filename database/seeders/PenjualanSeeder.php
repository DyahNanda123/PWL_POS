<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'penjualan_id' => 1,
                'user_id'=> 1,
                'pembeli' => 'Sahira', 
                'penjualan_kode' => '1', 
                'penjualan_tanggal'=> '2024-09-11'
            ],
            [
                'penjualan_id' => 2,
                'user_id'=> 1,
                'pembeli' => 'Rama', 
                'penjualan_kode' => '2', 
                'penjualan_tanggal'=> '2024-08-11'
            ],
            [
                'penjualan_id' => 3,
                'user_id'=> 1,
                'pembeli' => 'Kayy', 
                'penjualan_kode' => '3', 
                'penjualan_tanggal'=> '2024-09-12'
            ],
            [
                'penjualan_id' => 4,
                'user_id'=> 1,
                'pembeli' => 'Naka', 
                'penjualan_kode' => '4', 
                'penjualan_tanggal'=> '2024-09-09'
            ],
            [
                'penjualan_id' => 5,
                'user_id'=> 2,
                'pembeli' => 'Sukma', 
                'penjualan_kode' => '5', 
                'penjualan_tanggal'=> '2024-07-11'
            ],
            [
                'penjualan_id' => 6,
                'user_id'=> 2,
                'pembeli' => 'Tasya', 
                'penjualan_kode' => '6', 
                'penjualan_tanggal'=> '2024-06-10'
            ],
            [
                'penjualan_id' => 7,
                'user_id'=> 2,
                'pembeli' => 'Ratu', 
                'penjualan_kode' => '7', 
                'penjualan_tanggal'=> '2024-08-09'
            ],
            [
                'penjualan_id' => 8,
                'user_id'=> 3,
                'pembeli' => 'Nike', 
                'penjualan_kode' => '8', 
                'penjualan_tanggal'=> '2024-02-02'
            ],
            [
                'penjualan_id' => 9,
                'user_id'=> 3,
                'pembeli' => 'Yusa', 
                'penjualan_kode' => '9', 
                'penjualan_tanggal'=> '2024-08-08'
            ],
            [
                'penjualan_id' => 10,
                'user_id'=> 3,
                'pembeli' => 'Zaki', 
                'penjualan_kode' => '10', 
                'penjualan_tanggal'=> '2024-05-02'
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
