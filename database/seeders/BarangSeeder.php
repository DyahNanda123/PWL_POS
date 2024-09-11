<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'barang_id'=> 1,
                'kategori_id' => 1, 
                'barang_kode' => '1', 
                'barang_nama'=> 'Bedak Tabur Wardah',
                'harga_beli' => 40000,
                'harga_jual' => 55000
            ],
            [
                'barang_id'=> 2,
                'kategori_id' => 1, 
                'barang_kode' => '2', 
                'barang_nama'=> 'Lipstik Hanasui',
                'harga_beli' => 20000,
                'harga_jual' => 30000
            ],
            [
                'barang_id'=> 3,
                'kategori_id' => 1, 
                'barang_kode' => '3', 
                'barang_nama'=> 'Toner Hadalabo',
                'harga_beli' => 45000,
                'harga_jual' => 60000
            ],
            [
                'barang_id'=> 4,
                'kategori_id' => 2, 
                'barang_kode' => '4', 
                'barang_nama'=> 'Paracetamol',
                'harga_beli' => 5000,
                'harga_jual' => 10000
            ],
            [
                'barang_id'=> 5,
                'kategori_id' => 2, 
                'barang_kode' => '5', 
                'barang_nama'=> 'Amoxcilin',
                'harga_beli' => 7000,
                'harga_jual' => 10000
            ],
            [
                'barang_id'=> 6,
                'kategori_id' => 2, 
                'barang_kode' => '6', 
                'barang_nama'=> 'Mixagrib',
                'harga_beli' => 3000,
                'harga_jual' => 5000
            ],
            [
                'barang_id'=> 7,
                'kategori_id' => 3, 
                'barang_kode' => '7', 
                'barang_nama'=> 'Beras',
                'harga_beli' => 15000,
                'harga_jual' => 20000
            ],
            [
                'barang_id'=> 8,
                'kategori_id' => 3, 
                'barang_kode' => '8', 
                'barang_nama'=> 'Minyak',
                'harga_beli' => 15000,
                'harga_jual' => 22000
            ],
            [
                'barang_id'=> 9,
                'kategori_id' => 3, 
                'barang_kode' => '9', 
                'barang_nama'=> 'Tepung',
                'harga_beli' => 12000,
                'harga_jual' => 16000
            ],
            [
                'barang_id'=> 10,
                'kategori_id' => 4, 
                'barang_kode' => '10', 
                'barang_nama'=> 'Televisi',
                'harga_beli' => 1200000,
                'harga_jual' => 1500000
            ],
            [
                'barang_id'=> 11,
                'kategori_id' => 4, 
                'barang_kode' => '11', 
                'barang_nama'=> 'Kulkas',
                'harga_beli' => 2000000,
                'harga_jual' => 2500000
            ],
            [
                'barang_id'=> 12,
                'kategori_id' => 4, 
                'barang_kode' => '12', 
                'barang_nama'=> 'HandPhone',
                'harga_beli' => 1200000,
                'harga_jual' => 1700000
            ],
            [
                'barang_id'=> 13,
                'kategori_id' => 5, 
                'barang_kode' => '13', 
                'barang_nama'=> 'Sepatu Hiking',
                'harga_beli' => 950000,
                'harga_jual' => 1125000
            ],
            [
                'barang_id'=> 14,
                'kategori_id' => 5, 
                'barang_kode' => '14', 
                'barang_nama'=> 'Jaket',
                'harga_beli' => 800000,
                'harga_jual' => 920000
            ],
            [
                'barang_id'=> 15,
                'kategori_id' => 5, 
                'barang_kode' => '15', 
                'barang_nama'=> 'Topi',
                'harga_beli' => 200000,
                'harga_jual' => 235000
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
