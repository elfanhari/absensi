<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelajaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelas()
    {
      return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
      return $this->belongsTo(Mapel::class);
    }

    public function guru()
    {
      return $this->belongsTo(Guru::class);
    }

    public function pertemuan()
    {
      return $this->hasMany(Pertemuan::class);
    }

}
