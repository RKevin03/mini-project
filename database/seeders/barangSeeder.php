<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class barangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            [
            'kode_barang' => 'TES',
            'nama_barang' => 'Bola',
            'harga_barang'=> 2000,
            'deskripsi_barang' => 'barang bola',
            ],]);
    }
}
