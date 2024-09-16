<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Detail untuk Transaksi 1 (JL_1)
            [
                'penjualan_id' => 1,
                'barang_id' => 1, // Barang 1
                'harga' => 10000, // Harga jual barang 1
                'jumlah' => 3,
            ],
            [
                'penjualan_id' => 1,
                'barang_id' => 2, // Barang 2
                'harga' => 10000, 
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 1,
                'barang_id' => 3, // Barang 3
                'harga' => 12000, 
                'jumlah' => 1,
            ],
            // Detail untuk Transaksi 2 (JL_2)
            [
                'penjualan_id' => 2,
                'barang_id' => 4, // Barang 4
                'harga' => 5000, 
                'jumlah' => 3,
            ],
            [
                'penjualan_id' => 2,
                'barang_id' => 5, // Barang 5
                'harga' => 5000, 
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 2,
                'barang_id' => 6, // Barang 6
                'harga' => 5000, 
                'jumlah' => 5,
            ],
            // Detail untuk Transaksi 3 (JL_3)
            [
                'penjualan_id' => 3,
                'barang_id' => 7, // Barang 7
                'harga' => 75000, 
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 3,
                'barang_id' => 8, // Barang 8
                'harga' => 60000, 
                'jumlah' => 3,
            ],
            [
                'penjualan_id' => 3,
                'barang_id' => 9, // Barang 6
                'harga' => 80000, 
                'jumlah' => 3,
            ],
            // Detail untuk Transaksi 4 (JL_4)
            [
                'penjualan_id' => 4,
                'barang_id' => 10, // Barang 10
                'harga' => 80000, 
                'jumlah' => 3,
            ],
            [
                'penjualan_id' => 4,
                'barang_id' => 11, // Barang 11
                'harga' => 90000, 
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 4,
                'barang_id' => 12, // Barang 12
                'harga' => 55000, 
                'jumlah' => 2,
            ],
            // Detail untuk Transaksi 5 (JL_5)
            [
                'penjualan_id' => 5,
                'barang_id' => 13, // Barang 13
                'harga' => 75000, 
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 5,
                'barang_id' => 14, // Barang 14
                'harga' => 65000, 
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 5,
                'barang_id' => 15, // Barang 12
                'harga' => 70000, 
                'jumlah' => 2,
            ],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
