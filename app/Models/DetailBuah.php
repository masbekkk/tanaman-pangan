<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBuah extends Model
{
    use HasFactory;
    protected $table = 'detail_buah';

    public function buah()
    {
        return $this->belongsTo(Buah::class, 'buah_id', 'id');
    }
}
