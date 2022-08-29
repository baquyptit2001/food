<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xa extends Model
{
    use HasFactory;

    protected $table = 'devvn_xaphuongthitran';

    public function quan()
    {
        return $this->belongsTo(Quan::class, 'maqh', 'maqh');
    }
}
