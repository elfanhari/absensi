<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembelajaran()
    {
      return $this->belongsTo(Pembelajaran::class);
    }

    public function absen()
    {
      return $this->hasMany(Absen::class);
    }
}
