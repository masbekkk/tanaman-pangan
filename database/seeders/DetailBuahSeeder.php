<?php

namespace Database\Seeders;

use App\Models\DetailBuah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DetailBuahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(__DIR__ . '/detail_buah.csv', 'r');
        while (($data = fgetcsv($csvFile, 1000, ";")) !== FALSE) {
            // dd($data[0]);
            $detailBuah = new DetailBuah();
            $detailBuah->buah_id = (int) Str::replaceFirst("\u{FEFF}", "", $data[0]);
            $floatValue = str_replace('.', '', $data[1]);
            $detailBuah->luas_lahan = str_replace(',', '.', $floatValue);

            $floatValue = str_replace('.', '', $data[2]);
            $detailBuah->produksi = str_replace(',', '.', $floatValue);

            $floatValue = str_replace('.', '', $data[3]);
            $detailBuah->produktivitas = str_replace(',', '.', $floatValue);

            $detailBuah->tahun = $data[4];
            $detailBuah->save();
            
        }
        fclose($csvFile);
    }
}
