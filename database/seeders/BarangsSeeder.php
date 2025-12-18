<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barangs;

class BarangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barangs::create([
            'nama_barang' => 'Laptop Dell Inspiron',
            'kategori' => 'Laptop',
            'manufacturer' => 'Dell',
            'model' => 'Inspiron 15 3000',
            'serial_number' => 'DL123456',
            'asset_tag' => 'INV-ASSET001',
            'stok' => 1,
        ]);

        Barangs::create([
            'nama_barang' => 'Proyektor Epson',
            'kategori' => 'Proyektor',
            'manufacturer' => 'Epson',
            'model' => 'EB-S41',
            'serial_number' => 'EP123456',
            'asset_tag' => 'INV-ASSET002',
            'stok' => 1,
        ]);

        Barangs::create([
            'nama_barang' => 'Kamera Canon EOS',
            'kategori' => 'Kamera',
            'manufacturer' => 'Canon',
            'model' => 'EOS 1500D',
            'serial_number' => 'CA123456',
            'asset_tag' => 'INV-ASSET003',
            'stok' => 1,
        ]);

        Barangs::create([
            'nama_barang' => 'Kabel Data Type-C',
            'kategori' => 'Aksesoris',
            'stok' => 50,
        ]);
        
    }
}
