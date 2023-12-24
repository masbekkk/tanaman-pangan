<?php

namespace Database\Seeders;

use App\Models\Buah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(__DIR__ . '/buah.csv', 'r');
        while (($data = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
            $buah = new Buah();
            $buah->nama_buah = $data[0];
            // $floatValue = str_replace('.', '', $data[1]);
            // $buah->luas_panen = str_replace(',', '.', $floatValue);

            // $floatValue = str_replace('.', '', $data[2]);
            // $buah->jml_produksi = str_replace(',', '.', $floatValue);

            // $floatValue = str_replace('.', '', $data[3]);
            // $buah->produktivitas_per_luas = str_replace(',', '.', $floatValue);
            
            // $buah->tahun = $data[4];
            // dd($buah->toSql());
            $buah->save();
        
        }
        fclose($csvFile);
    }
}
