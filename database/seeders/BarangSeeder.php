<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {

        $data =[
            ['merk' => 'Panasonic',
             'seri' => 'CS-PC5QKJ',
             'spesifikasi' => '1/2 PK, Daya 395 Watt',
             'kategori_id' => '1'],
            ['merk' => 'Sharp',
             'seri' => 'AH-A9PEY',
             'spesifikasi' => '1 PK, Daya 900 Watt',
             'kategori_id' => '1'],
            ['merk' => 'Asus',
             'seri' => 'S340MC',
             'spesifikasi' => 'Processor Intel Core I7, memory 8GB DDR4, HDD SATA 1 TB, OS Win 10 Home, Monitor 19,5 inch',
             'kategori_id' => '2'],
            ['merk' => 'HP Hawlett Packard',
             'seri' => 'Pavilion Aero 13 be2001AU',
             'spesifikasi' => 'Processor AMD Ryzen, memory 16GB DDR4, SSD 512 GB, OS Win 11 Home, Display 13,3 inch',
             'kategori_id' => '2']
        ];

        Barang::insert($data);

    }
}
