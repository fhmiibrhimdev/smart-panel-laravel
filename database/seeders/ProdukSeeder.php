<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 5000; $i++) {
            $data[] = [
                'kategori'     => 'produk',
                'nama_produk'  => 'product ' . $i,
                'harga'        => rand(10000, 100000), // Harga random antara 10.000 s/d 100.000
                'komisi'       => 10,
            ];
        }

        collect($data)->chunk(1000)->each(function ($chunk) {
            Produk::insert($chunk->toArray());
        });
    }
}
