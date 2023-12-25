<?php

namespace App\Http\Controllers;

use App\Models\DetailBuah;
use Illuminate\Http\Request;

class DetailBuahController extends Controller
{
    function detailBuah($id)
    {
        $detailBuah = DetailBuah::where('buah_id', $id)->with('buah')->get();
        // dd($detailBuah);
        return view('tanaman_pangan.detail', [
            'data' => $detailBuah,
            'dataBuah' => $detailBuah->first(),
        ]);
    }

    function getDrilldownByTahun()
    {
        $resultsLuasLahan = [];
        $drillDownLuasLahan = [];
        $resultsProduksi = [];
        $drillDownProduksi = [];
        $resultsProduktivitas = [];
        $drillDownProduktivitas = [];
        $detailBuahPerTahun = DetailBuah::distinct()->get(['tahun']);
        
        foreach ($detailBuahPerTahun as $key => $value) {
            $buahByTahun = DetailBuah::where('tahun', $value->tahun)->get();
            
            $seriesLuasLahan = [
                'name' => $value->tahun,
                'y' => $buahByTahun->avg('luas_lahan'),
                'drilldown' => $value->tahun,
            ];
        
            $resultsLuasLahan[] = $seriesLuasLahan;

            $seriesProduksi = [
                'name' => $value->tahun,
                'y' => $buahByTahun->avg('produksi'),
                'drilldown' => $value->tahun,
            ];
        
            $resultsProduksi[] = $seriesProduksi;

            $seriesProduktivitas = [
                'name' => $value->tahun,
                'y' => $buahByTahun->avg('produktivitas'),
                'drilldown' => $value->tahun,
            ];
        
            $resultsProduktivitas[] = $seriesProduktivitas;
        
            $dataBuahByLuasLahan = [];
            $dataBuahByProduksi = [];
            $dataBuahByProduktivitas = [];
        
            foreach ($buahByTahun as $data) {
                $dataBuahByLuasLahan[] = [$data->buah->nama_buah, $data->luas_lahan];
                $dataBuahByProduksi[] = [$data->buah->nama_buah, $data->produksi];
                $dataBuahByProduktivitas[] = [$data->buah->nama_buah, $data->produktivitas];
            }
        
            $drillDownLuasLahan[] = [
                'name' => $value->tahun,
                'id' => $value->tahun,
                'data' => $dataBuahByLuasLahan,
            ];

            $drillDownProduksi[] = [
                'name' => $value->tahun,
                'id' => $value->tahun,
                'data' => $dataBuahByProduksi,
            ];

            $drillDownProduktivitas[] = [
                'name' => $value->tahun,
                'id' => $value->tahun,
                'data' => $dataBuahByProduktivitas,
            ];
        }
        
        return response()->json([
            'resultsLuasLahan' => $resultsLuasLahan, 
            'drilldownLuasLahan' => $drillDownLuasLahan,
            'resultsProduksi' => $resultsProduksi, 
            'drilldownProduksi' => $drillDownProduksi,
            'resultsProduktivitas' => $resultsProduktivitas, 
            'drilldownProduktivitas' => $drillDownProduktivitas,
        ]);
        
        // $data = DetailBuah::with('buah')->where('tahun', '2009')->groupBy('buah_id')->get();
        // dd($data);
        // dd($detailBuahPerTahun);
        // dd(DetailBuah::where('tahun', '2009')->avg('luas_lahan'));
     
    }
}
