<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tinh extends Model
{
    use HasFactory;

    protected $table = 'devvn_tinhthanhpho';

    public function quan()
    {
        return $this->hasMany(Quan::class, 'matp', 'matp');
    }
}
