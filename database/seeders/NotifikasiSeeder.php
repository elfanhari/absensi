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
          [
            'pengirim_id' => 1,
            'penerima_id' => 7,
            'judul' => 'Pelanggaran Terlambat',
            'isi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore consequuntur repellendus aut sit. Libero voluptatem totam nemo dolorem, beatae necessitatibus?',
            'kategori' => 'Peringatan',
          ],
          [
            'pengirim_id' => 1,
            'penerima_id' => 7,
            'judul' => 'Informasi Kehadiran',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde sunt dicta, illum accusamus odio omnis sit quas eum alias labore ut possimus maxime odit! Aspernatur!',
            'kategori' => 'Informasi',
            'dibaca' => true,
          ],
        ])->each(fn($q) => Notifikasi::create($q));
    }
}
