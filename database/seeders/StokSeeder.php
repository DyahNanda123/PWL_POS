<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'supplier_id' => 1,
                'barang_id'=> 1,
                'user_id' => 1, 
                'stok_tanggal' => '2024-09-11 14:00:00', 
                'stok_jumlah'=> 10
            ],
            [
                'supplier_id' => 1,
                'barang_id'=> 2,
                'user_id' => 1, 
                'stok_tanggal' => '2024-09-1 14:00:00', 
                'stok_jumlah'=> 15
            ],
            [
                'supplier_id' => 1,
                'barang_id'=> 3,
                'user_id' => 1, 
                'stok_tanggal' => '2024-08-11 10:00:00', 
                'stok_jumlah'=> 7
            ],
            [
                'supplier_id' => 1,
                'barang_id'=> 4,
                'user_id' => 1, 
                'stok_tanggal' => '2024-05-11 04:00:00', 
                'stok_jumlah'=> 8
            ],
            [
                'supplier_id' => 1,
                'barang_id'=> 5,
                'user_id' => 1, 
                'stok_tanggal' => '2024-07-11 10:00:00', 
                'stok_jumlah'=> 13
            ],
            [
                'supplier_id' => 2,
                'barang_id'=> 6,
                'user_id' => 2, 
                'stok_tanggal' => '2024-10-01 13:00:00', 
                'stok_jumlah'=> 14
            ],
            [
                'supplier_id' => 2,
                'barang_id'=> 7,
                'user_id' => 2, 
                'stok_tanggal' => '2024-12-12 11:00:00', 
                'stok_jumlah'=> 20
            ],
            [
                'supplier_id' => 2,
                'barang_id'=> 8,
                'user_id' => 2, 
                'stok_tanggal' => '2024-10-02 13:00:00', 
                'stok_jumlah'=> 21
            ],
            [
                'supplier_id' => 2,
                'barang_id'=> 9,
                'user_id' => 2, 
                'stok_tanggal' => '2024-01-02 13:00:00', 
                'stok_jumlah'=> 22
            ],
            [
                'supplier_id' => 2,
                'barang_id'=> 10,
                'user_id' => 2, 
                'stok_tanggal' => '2024-10-04 09:00:00', 
                'stok_jumlah'=> 19
            ],
            [
                'supplier_id' => 3,
                'barang_id'=> 11,
                'user_id' => 3, 
                'stok_tanggal' => '2024-10-01 13:00:00', 
                'stok_jumlah'=> 22
            ],
            [
                'supplier_id' => 3,
                'barang_id'=> 12,
                'user_id' => 3, 
                'stok_tanggal' => '2024-03-01 11:00:00', 
                'stok_jumlah'=> 21
            ],
            [
                'supplier_id' => 3,
                'barang_id'=> 13,
                'user_id' => 3, 
                'stok_tanggal' => '2024-10-01 15:00:00', 
                'stok_jumlah'=> 21
            ],
            [
                'supplier_id' => 3,
                'barang_id'=> 14,
                'user_id' => 3, 
                'stok_tanggal' => '2024-07-01 07:00:00', 
                'stok_jumlah'=> 17
            ],
            [
                'supplier_id' => 3,
                'barang_id'=> 15,
                'user_id' => 3, 
                'stok_tanggal' => '2024-10-01 13:00:00', 
                'stok_jumlah'=> 22
            ],
        ];
        DB::table('t_stok')->insert($data);
    }
}
