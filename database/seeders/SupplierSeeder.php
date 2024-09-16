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
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' =>'AGT',
                'supplier_nama' => 'Agta',
                'supplier_alamat' => 'Jl. sulfat'
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' =>'WLD',
                'supplier_nama' => 'Wildan',
                'supplier_alamat' => 'Jl. basuki'
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' =>'RK',
                'supplier_nama' => 'Raka',
                'supplier_alamat' => 'Jl. remujung'
            ],
        ];    
        DB::table('m_supplier')->insert($data);
    }
}
