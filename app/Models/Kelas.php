<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tapel()
    {
      return $this->belongsTo(Tapel::class);
    }

    public function guru()
    {
      return $this->belongsTo(Guru::class);
    }

    public function siswa()
    {
      return $this->hasMany(Siswa::class);
    }

    public function pembelajaran()
    {
      return $this->hasMany(Pembelajaran::class);
    }

}
