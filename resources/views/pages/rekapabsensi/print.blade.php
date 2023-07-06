<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REKAPITULASI ABSENSI - {{ $pembelajaran->kelas->name }} | {{ $pembelajaran->mapel->name }}</title>

    {{-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="my-css/style.css">

    <style>
        .fs-12 {
            font-size: 12px;
        }

        .fs-14 {
            font-size: 14px;
        }
    </style>

    {{-- <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet"> --}}

</head>

<body style="font-family: Figtree">


    <div class="">

        <div class=" mt-3">

            <img src="img/{{ $sekolah->logo ?? 'logo.png' }}" alt="" style="width: 100px"
                class="text-start position-absolute rounded-circle" />
            <div class="text-center">
                <h3 class="fw-bold mb-1">REKAPITULASI ABSENSI</h3>
                <h3 class="fw-bold">{{ $sekolah->name ?? '' }}</h3>
                <p>{{ $sekolah->alamat ?? '' }}</p>
                <hr />
            </div>

            <div class="row my-3 mx-1">
              <b>Mata Pelajaran</b> : {{ $pembelajaran->mapel->name }} <br>
              <b> Kelas</b> : {{ $pembelajaran->kelas->name }} <br>
              <b> Guru Pengampu</b> : {{ $pembelajaran->guru->name }} <br>
              <b> Tahun Pelajaran</b> : {{ $pembelajaran->kelas->tapel->tahun_pelajaran }} - Semester {{ $pembelajaran->kelas->tapel->semester }}
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover table-bordered border-dark">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th scope="col" rowspan="2" class="border-dark text-center align-middle bg-info">#
                            </th>
                            <th scope="col" rowspan="2" class="border-dark text-center align-middle bg-info">NIS
                            </th>
                            <th scope="col" rowspan="2" class="border-dark text-center align-middle bg-info">Nama
                                Siswa</th>

                            @if ($pertemuan->count() >= 1)
                                <th scope="col" colspan="{{ count($pertemuan) }}"
                                    class="bg-info text-center border-dark">
                                    Pertemuan Ke</th>
                                <th scope="col" colspan="5" class="bg-info text-center border-dark">
                                    Jumlah</th>
                            @endif
                        </tr>
                        <tr class="bg-yellow">

                            @if ($pertemuan->count() >= 1)
                                @foreach ($pertemuan as $pert)
                                    <th scope="col" class="border-dark" data-bs-toggle="modal"
                                        @if ($role != 'siswa') data-bs-placement="top" title="Klik untuk detail">
                        <div class=""
                          data-bs-target="#detailPertemuan/{{ $pert->id }}"
                            data-bs-toggle="modal" @endif>
                                        <div class="text-center align-middle">{{ $pert->pertemuan_ke }}
                                        </div>

            </div>
            </th>
            @endforeach
            <th class="bg-success border-dark align-middle text-center" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Hadir">
                H
            </th>
            <th class="bg-secondary border-dark align-middle text-center" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Sakit">
                S
            </th>
            <th class="bg-primary border-dark align-middle text-center" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Izin">
                I
            </th>
            <th class="bg-danger border-dark align-middle text-center" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Alpa">
                A
            </th>
            <th class="bg-warning border-dark align-middle text-center" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Terlambat">
                T
            </th>
            @endif
            </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $index => $item)
                    <tr>
                        <td class="border-dark">{{ $loop->iteration }}</td>
                        <td class="border-dark">{{ $item->nis }}</td>
                        <td class="border-dark text-uppercase">{{ $item->name }}</td>

                        @if ($pertemuan->count() >= 1)
                            @foreach ($pertemuan as $pert)
                                <td class="border-dark">
                                    @if ($item->absen->where('siswa_id', $item->id)->where('pertemuan_id', $pert->id)->count() < 1)
                                        <span class="badge bg-warning px-2">Belum <br>
                                            Diinput</span>
                                    @else
                                        {{ $item->absen->where('siswa_id', $item->id)->where('pertemuan_id', $pert->id)->first()->keterangan }}
                                    @endif
                                </td>
                            @endforeach

                            {{-- @foreach ($absen as $abs) --}}
                            <td class="border-dark">
                                {{ $item->absen->where('keterangan', 'H')->count() < 1 ? '' : $item->absen->where('keterangan', 'H')->count() }}
                            </td>
                            <td class="border-dark">
                                {{ $item->absen->where('keterangan', 'S')->count() < 1 ? '' : $item->absen->where('keterangan', 'S')->count() }}
                            </td>
                            <td class="border-dark">
                                {{ $item->absen->where('keterangan', 'I')->count() < 1 ? '' : $item->absen->where('keterangan', 'I')->count() }}
                            </td>
                            <td class="border-dark">
                                {{ $item->absen->where('keterangan', 'A')->count() < 1 ? '' : $item->absen->where('keterangan', 'A')->count() }}
                            </td>
                            <td class="border-dark">
                                {{ $item->absen->where('keterangan', 'T')->count() < 1 ? '' : $item->absen->where('keterangan', 'T')->count() }}
                            </td>
                            {{-- @endforeach --}}
                        @endif

                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>

    </div>

</body>

</html>
