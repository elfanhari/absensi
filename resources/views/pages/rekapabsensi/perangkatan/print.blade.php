@php
    use Carbon\Carbon;
    use App\Models\Absen;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REKAPITULASI ABSENSI PER-TINGKAT</title>

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
            <div class="text-center" style="text-align: center">
                <h3 class="fw-bold mb-1" style="margin-top: 0px; margin-bottom: 0px;">REKAPITULASI ABSENSI</h3>
                <h3 class="fw-bold" style="margin-top: 0px; margin-bottom: 0px;">{{ $sekolah->name ?? '' }}</h3>
                <p style="margin-top: 0px; margin-bottom: 0px; ">{{ $sekolah->alamat ?? '' }}</p>
                <hr />
            </div>

            <div class="">
              <table border="0" cellspacing="1">
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
                    <th class="border-dark text-center align-middle bg-info" rowspan="2" style="min-width: 200px">Tingkat</th>
                    <th class="border-dark text-center align-middle bg-info" colspan="4">Jumlah</th>
                  </tr>
                  <tr class="bg-secondary">
                    <th class="bg-success border-dark align-middle text-center" style="min-width: 30px">H</th>
                    <th class="bg-primary border-dark align-middle text-center" style="min-width: 30px">S</th>
                    <th class="bg-warning border-dark align-middle text-center" style="min-width: 30px">I</th>
                    <th class="bg-danger border-dark align-middle text-center" style="min-width: 30px">A</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tingkat as $item)
                      <tr class="border-dark">
                        <td class="border-dark">{{ $loop->iteration }}</td>
                        <td class="border-dark">Kelas {{ $item['int'] }} {{ '(' . $item['str'] . ')' }}</td>

                        @php
                            $absenModel = new Absen();
                            $H = $absenModel->hitungJumlahAbsenPerTingkat($item['int'], $tglAwal, $tglAkhir, 'H');
                            $S = $absenModel->hitungJumlahAbsenPerTingkat($item['int'], $tglAwal, $tglAkhir, 'S');
                            $I = $absenModel->hitungJumlahAbsenPerTingkat($item['int'], $tglAwal, $tglAkhir, 'I');
                            $A = $absenModel->hitungJumlahAbsenPerTingkat($item['int'], $tglAwal, $tglAkhir, 'A');
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
