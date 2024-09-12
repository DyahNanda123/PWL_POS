<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'supplier_id'=> 1,
                'supplier_kode' => '1', 
                'supplier_nama' => 'Berkah Rejeki', 
                'supplier_alamat'=> 'Jakarta Selatan'
            ],
            [
                'supplier_id'=> 2,
                'supplier_kode' => '2', 
                'supplier_nama' => 'PT Agung Sejahtera', 
                'supplier_alamat'=> 'Surabaya'
            ],
            [
                'supplier_id'=> 3,
                'supplier_kode' => '3', 
                'supplier_nama' => 'PT Gajayana', 
                'supplier_alamat'=> 'Bandung'
            ],
        ];
        DB::table('m_supplier')->insert($data);
    }
}