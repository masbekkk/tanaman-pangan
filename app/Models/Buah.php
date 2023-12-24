<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buah extends Model
{
    use HasFactory;

    protected $table = 'buah';

    public function detailBuah()
    {
        return $this->hasMany(DetailBuah::class, 'id', 'buah_id');
    }
}
