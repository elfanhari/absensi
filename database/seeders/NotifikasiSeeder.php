<?php

namespace Database\Seeders;

use App\Models\Mapel;
use App\Models\Notifikasi;
use Illuminate\Database\Seeder;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
          [
            'pengirim_id' => 1,
            'penerima_id' => 7,
            'judul' => 'Hukuman Tidak Hadir',
            'isi' => 'Kamu tidak hadir di kelas saya pada pertemuan di hari Senin kemarin, sebagai hukumannya silahkan buat makalah (tulis tangan)',
            'kategori' => 'Peringatan',
          ],
        ])->each(fn($q) => Notifikasi::create($q));
    }
}
