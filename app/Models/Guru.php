<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
      return $this->hasOne(Kelas::class);
    }

    function pembelajaran()
    {
      return $this->hasMany(Pembelajaran::class);
    }
}
