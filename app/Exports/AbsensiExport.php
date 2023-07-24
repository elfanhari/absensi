<?php

namespace App\Exports;

use App\Models\Absen;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

class AbsensiExport implements FromView
{
    use Exportable;

    protected $siswa;

    public function __construct($siswa)
    {
        $this->siswa = $siswa;
    }

    public function view(): View
    {
        return view('pages.rekapabsensi.per1bulan.export', [
            'siswa' => $this->siswa,
            'absen' => Absen::get(),
            'months' =>
        ]);
    }
}
