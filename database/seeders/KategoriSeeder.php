<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
     public function run(): void
    {
$data =[
            
            ['kategori' => 'Pendingin Ruang',
             'jenis' => 'M'],
             ['kategori' => 'Personal Komputer',
             'jenis' => 'M'],
             ['kategori' => 'Laptop',
             'jenis' => 'M'],
             ['kategori' => 'Speaker Active',
             'jenis' => 'M'],
             ['kategori' => 'Scanner',
             'jenis' => 'M'],
             ['kategori' => 'Printer',
             'jenis' => 'M'],
             ['kategori' => 'Projector',
             'jenis' => 'M'],
             ['kategori' => 'Projector Screen',
             'jenis' => 'M'],
             ['kategori' => 'Mesin Bor',
             'jenis' => 'M'],
             ['kategori' => 'Alat Berat',
             'jenis' => 'A'],
             ['kategori' => 'Crimping Tools',
             'jenis' => 'A'],
             ['kategori' => 'Obeng',
             'jenis' => 'A'],
             ['kategori' => 'Tang',
             'jenis' => 'A'],
             ['kategori' => 'Alat Ukur',
             'jenis' => 'A'],
             ['kategori' => 'Solder',
             'jenis' => 'A'],
             ['kategori' => 'Konektor Jaringan | Bahan Praktik',
             'jenis' => 'BHP'],
             ['kategori' => 'Kabel Jumper | Bahan Praktik',
             'jenis' => 'BHP'],
             ['kategori' => 'Perangkat Jaringan | Bahan Praktik',
             'jenis' => 'BTHP'],
             ['kategori' => 'Mikrokontroller Board | Bahan Praktik',
             'jenis' => 'BTHP'],
             ['kategori' => 'Mikrokontroller Module | Bahan Praktik',
             'jenis' => 'BTHP'],
             ['kategori' => 'Komponen Elektronika | Bahan Praktik',
             'jenis' => 'BTHP']
        ];

        Kategori::insert($data);

    }
}
