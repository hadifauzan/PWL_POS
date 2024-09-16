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
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 3,
                'pembeli' => 'Rio',
                'penjualan_kode' => 'JL_01',
                'penjualan_tanggal' => '2024-6-27',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 3,
                'pembeli' => 'Ivan',
                'penjualan_kode' => 'JL_02',
                'penjualan_tanggal' => '2024-6-27',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Taufik',
                'penjualan_kode' => 'JL_03',
                'penjualan_tanggal' => '2024-6-27',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 3,
                'pembeli' => 'Rafli',
                'penjualan_kode' => 'JL_04',
                'penjualan_tanggal' => '2024-6-27',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 3,
                'pembeli' => 'Ervan',
                'penjualan_kode' => 'JL_05',
                'penjualan_tanggal' => '2024-6-27',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Ian',
                'penjualan_kode' => 'JL_06',
                'penjualan_tanggal' => '2024-6-27',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Jibril',
                'penjualan_kode' => 'JL_07',
                'penjualan_tanggal' => '2024-6-27',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Raihan',
                'penjualan_kode' => 'JL_08',
                'penjualan_tanggal' => '2024-6-27',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Yogo',
                'penjualan_kode' => 'JL_09',
                'penjualan_tanggal' => '2024-6-27',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Faris',
                'penjualan_kode' => 'JL_10',
                'penjualan_tanggal' => '2024-6-27',
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
