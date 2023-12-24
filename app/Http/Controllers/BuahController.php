<?php

namespace App\Http\Controllers;

use App\Models\Buah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuahController extends Controller
{
    function getBuah()
    {
        return response(['data' => Buah::all()], 200);
    }

    function testQuery()
    {
        // Listen for query events
        DB::listen(function ($query) {
            dump($query->sql, $query->bindings);
        });

        $buah = new Buah();
        $buah->nama_buah = 'Mangga';

        // Save the model
        $buah->save();
    }
}
