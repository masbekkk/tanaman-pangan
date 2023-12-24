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
}
