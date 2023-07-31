@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REKAPITULASI ABSENSI - {{ $kelas->name }}</title>

    <style>
        .fs-12 {
            font-size: 12px;
        }

        .fs-11 {
            font-size: 11px;
        }

        .fs-14 {
            font-size: 14px;
        }
    </style>

</head>

<body style="font-family: 'Times New Roman';  font-size: 14px"">

    <div>

        <div class="mt-0">
            <div class="text-center" style="text-align: center" >
                <h3 class="fw-bold mb-1" style="margin-top: 0px; margin-bottom: 0px;">REKAPITULASI ABSENSI</h3>
                <h3 class="fw-bold" style="margin-top: 0px; margin-bottom: 0px;">{{ $sekolah->name ?? '' }}</h3>
                <p style="margin-top: 0px; margin-bottom: 0px;">{{ $sekolah->alamat ?? '' }}</p>
                <hr />
            </div>

            <div class="">
              <table border="0" cellspacing="1">
                <tr>
                  <td style="font-weight: bold">Kelas</td>
                  <td>:</td>
                  <td>{{ $kelas->name }} </td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Wali Kelas</td>
                  <td>:</td>
                  <td>{{ $kelas->guru->name }}</td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Tahun Pelajaran</td>
                  <td>:</td>
                  <td>{{ $kelas->tapel->tahun_pelajaran }} Semester {{ $kelas->tapel->semester }}</td>
                </tr>
                <tr>
                  <td style="font-weight: bold">Periode Absen</td>
                  <td>:</td>
                  <td>{{ $periode }}</td>
                </tr>
              </table>
            </div>

            <hr>

            <div class="table-responsive">
              <table class="table table-sm table-hover table-bordered border-dark" border="1" cellspacing="0"  style="width: 100%">

                <thead>
                  <tr class="border-dark">
                    <th class="border-dark text-center align-middle bg-info" rowspan="2">#</th>
                    <th class="border-dark text-center align-middle bg-info" rowspan="2">NIS</th>
                    <th class="border-dark text-center align-middle bg-info" rowspan="2" style="min-width: 200px">Nama Siswa</th>
                    <th class="border-dark text-center align-middle bg-info" rowspan="2">L/P</th>
                    <th class="border-dark text-center align-middle bg-info" colspan="4" >Jumlah</th>
                  </tr>
                  <tr class="bg-secondary">
                    <th class="bg-success border-dark align-middle text-center" style="min-width: 30px">H</th>
                    <th class="bg-primary border-dark align-middle text-center" style="min-width: 30px">S</th>
                    <th class="bg-warning border-dark align-middle text-center" style="min-width: 30px">I</th>
                    <th class="bg-danger border-dark align-middle text-center" style="min-width: 30px">A</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($siswa as $index => $item)
                      <tr class="border-dark">
                        <td class="border-dark">{{ $loop->iteration }}</td>
                        <td class="border-dark">{{ $item->nis }}</td>
                        <td class="border-dark">{{ $item->name }}</td>
                        <td class="border-dark" style="text-align: center">{{ $item->jk }}</td>

                        @php
                            $H = $item->hitungJumlahAbsen($tglAwal, $tglAkhir, 'H');
                            $S = $item->hitungJumlahAbsen($tglAwal, $tglAkhir, 'S');
                            $I = $item->hitungJumlahAbsen($tglAwal, $tglAkhir, 'I');
                            $A = $item->hitungJumlahAbsen($tglAwal, $tglAkhir, 'A');
                        @endphp

                        <td class="border-dark" style="text-align: center">{{ $H > 0 ? $H : '' }}</td>
                        <td class="border-dark" style="text-align: center">{{ $S > 0 ? $S : '' }}</td>
                        <td class="border-dark" style="text-align: center">{{ $I > 0 ? $I : '' }}</td>
                        <td class="border-dark" style="text-align: center">{{ $A > 0 ? $A : '' }}</td>
                      </tr>
                  @endforeach
                </tbody>

              </table>
            </div>

        </div>

</body>

</html>
