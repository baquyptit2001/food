<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quan extends Model
{
    use HasFactory;

    protected $table = 'devvn_quanhuyen';

    public function tinh()
    {
        return $this->belongsTo(Tinh::class, 'matp', 'matp');
    }

    public function xa()
    {
        return $this->hasMany(Xa::class, 'maqh', 'maqh');
    }
}
