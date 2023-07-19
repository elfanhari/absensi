<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function userPengirim() //relasiInverse
    {
        return $this->belongsTo(User::class, 'pengirim_id', 'id');
    }

    public function userPenerima() //relasiInverse
    {
        return $this->belongsTo(User::class, 'penerima_id', 'id');
    }

    public static function semuaNotifSaya($authId)
    {
      return self::where('penerima_id', $authId)->latest()->get();
    }

    public static function belumDibaca($authId)
    {
      return self::where('penerima_id', $authId)->where('dibaca', false)->latest()->get();
    }

    public static function telahDibaca($authId)
    {
      return self::where('penerima_id', $authId)->where('dibaca', true)->latest()->get();
    }

}
