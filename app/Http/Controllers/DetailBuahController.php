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
    }

    function getDrilldownByLuasLahan()
    {
        $resultsBuahByLuasLahan = [];
        $drillDownBuahByLuasLahan = [];
        $buah = DetailBuah::distinct()->get(['buah_id']);

        foreach ($buah as $key => $value) {
            $buahByBuahId = DetailBuah::where('buah_id', $value->buah_id)->get();

            $seriesLuasLahan = [
                'name' => $value->buah->nama_buah,
                'y' => $buahByBuahId->avg('luas_lahan'),
                'drilldown' => $value->buah->nama_buah,
            ];

            $resultsBuahByLuasLahan[] = $seriesLuasLahan;

            $dataBuahByLuasLahan = [];

            foreach ($buahByBuahId as $data) {
                $dataBuahByLuasLahan[] = [$data->tahun, $data->luas_lahan];
            }

            $drillDownBuahByLuasLahan[] = [
                'name' => $value->buah->nama_buah,
                'id' => $value->buah->nama_buah,
                'data' => $dataBuahByLuasLahan,
            ];
        }

        return response()->json([
            'buahByLuasLahan' => $resultsBuahByLuasLahan,
            'drillDownBuahByLuasLahan' => $drillDownBuahByLuasLahan,
        ]);
    }

    function getDrilldownByProduksi()
    {
        $resultsBuahByProduksi = [];
        $drillDownBuahByProduksi = [];
        $buah = DetailBuah::distinct()->get(['buah_id']);

        foreach ($buah as $key => $value) {
            $buahByBuahId = DetailBuah::where('buah_id', $value->buah_id)->get();

            $seriesProduksi = [
                'name' => $value->buah->nama_buah,
                'y' => $buahByBuahId->avg('produksi'),
                'drilldown' => $value->buah->nama_buah,
            ];

            $resultsBuahByProduksi[] = $seriesProduksi;

            $dataBuahByProduksi = [];

            foreach ($buahByBuahId as $data) {
                $dataBuahByProduksi[] = [$data->tahun, $data->produksi];
            }

            $drillDownBuahByProduksi[] = [
                'name' => $value->buah->nama_buah,
                'id' => $value->buah->nama_buah,
                'data' => $dataBuahByProduksi,
            ];
        }

        return response()->json([
            'buahByProduksi' => $resultsBuahByProduksi,
            'drillDownBuahByProduksi' => $drillDownBuahByProduksi,
        ]);
    }

    function getDrilldownByProduktivitas()
    {
        $resultsBuahByProduktivitas = [];
        $drillDownBuahByProduktivitas = [];
        $buah = DetailBuah::distinct()->get(['buah_id']);

        foreach ($buah as $key => $value) {
            $buahByBuahId = DetailBuah::where('buah_id', $value->buah_id)->get();

            $seriesProduktivitas = [
                'name' => $value->buah->nama_buah,
                'y' => $buahByBuahId->avg('produktivitas'),
                'drilldown' => $value->buah->nama_buah,
            ];

            $resultsBuahByProduktivitas[] = $seriesProduktivitas;

            $dataBuahByProduktivitas = [];

            foreach ($buahByBuahId as $data) {
                $dataBuahByProduktivitas[] = [$data->tahun, $data->produktivitas];
            }

            $drillDownBuahByProduktivitas[] = [
                'name' => $value->buah->nama_buah,
                'id' => $value->buah->nama_buah,
                'data' => $dataBuahByProduktivitas,
            ];
        }

        return response()->json([
            'buahByProduktivitas' => $resultsBuahByProduktivitas,
            'drillDownBuahByProduktivitas' => $drillDownBuahByProduktivitas,
        ]);
    }
}
