@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
@endphp

@section('css')
  <style>
    .vertical {
      transform: rotate(180deg);
    }

    .bg-H {
        background-color: #28a745
    }

    .bg-S {
      background-color:#007bff
    }

    .bg-I{
      background-color: #ffc107
    }

    .bg-A{
      background-color: #dc3545
    }
  </style>
@endsection

@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-0">
                <div class="col-sm-6">
                    <h4 class="fw-bold poppins m-0">
                      <a href="{{ route('absensi.show', [auth()->user()->role, $kelas->id]) }}" class="btn btn-sm btn-link p-0 me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi fw-bold bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                    </a>
                      Absensi: {{ $kelas->name }}
                    </h4>
                </div>
                <div class="col-sm-6 mt-xs-2">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            @include('_success')
                            {!! session('success') !!}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">

                          <div class="callout callout-warning my-1">
                              <div class="row">
                                  <div class="col">
                                      <div class="row">
                                        <div class="table-responsive">
                                          <table class="table-borderless">
                                            <tr>
                                              <td class="fw-bold">Kelas</td>
                                              <td style="width: 1px" class="px-2">:</td>
                                              <td>{{ $kelas->name }}</td>
                                            </tr>
                                            <tr>
                                              <td class="fw-bold">Wali Kelas</td>
                                              <td style="width: 1px" class="px-2">:</td>
                                              <td>{{ $kelas->guru->name }}</td>
                                            </tr>
                                            <tr>
                                              <td class="fw-bold">Tahun Pelajaran</td>
                                              <td style="width: 1px" class="px-2">:</td>
                                              <td>{{  $kelas->tapel->tahun_pelajaran  }} - Semester {{ $kelas->tapel->semester }}</td>
                                            </tr>
                                            <tr>
                                              <td class="fw-bold">Bulan</td>
                                              <td style="width: 1px" class="px-2">:</td>
                                              <td>{{ $monthIndo }}</td>
                                            </tr>
                                          </table>
                                        </div>

                                      </div>
                                  </div>
                              </div>
                          </div>

                        </div>

                        <div class="card-body">

                          <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered border-dark">

                              <thead>
                                <tr class="border-dark">
                                  <th class="border-dark text-center align-middle bg-info" rowspan="2">#</th>
                                  <th class="border-dark text-center align-middle bg-info" rowspan="2" style="min-width: 200px">Nama Siswa</th>
                                  <th class="border-dark text-center align-middle bg-info" rowspan="2">NIS</th>
                                  <th class="border-dark text-center align-middle bg-info" rowspan="2">L/P</th>
                                  <th class="border-dark text-center align-middle bg-info" colspan="{{ count($months) }}">Tanggal</th>
                                  <th class="border-dark text-center align-middle bg-info" colspan="4" >Jumlah</th>
                                </tr>
                                <tr class="bg-secondary">
                                  @foreach ($months as $i => $date)
                                    @if (Str::before(Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM Y'), ',') == 'Sabtu' || Str::before(Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM Y'), ',') == 'Minggu')
                                      <th class="border-dark text-center bg-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}">
                                        {{ Str::afterLast($date, '-') }}
                                      </th>
                                    @elseif ($libur->pluck('tgl')->contains($date))
                                      <th class="border-dark text-center bg-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}">
                                        {{ Str::afterLast($date, '-') }}
                                      </th>
                                    @else
                                      <th class="border-dark text-center" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}">

                                        @php
                                            $dateString = $date;
                                            list($year, $month, $day) = explode('-', $dateString);

                                            // Mengubah ke format UNIX timestamp menggunakan mktime()
                                            $timestamp = mktime(0, 0, 0, $month, $day, $year);

                                            // Atau, Anda juga bisa menggunakan strtotime()
                                            $timestamp = strtotime($dateString);
                                            $key = $timestamp . '_' . Str::random(10);
                                        @endphp

                                        @if (Auth::user()->role == 'siswa')
                                          {{ Str::afterLast($date, '-') }}
                                        @else
                                        <a href="{{ route('absensi.kelas.day.get', [$role,  $kelas->id, $month, $date, $key]) }}" class="text-white">
                                          {{ Str::afterLast($date, '-') }}
                                        </a>
                                          @endif
                                      </th>
                                    @endif
                                  @endforeach
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
                                      <td class="border-dark">{{ $item->name }}</td>
                                      <td class="border-dark">{{ $item->nis }}</td>
                                      <td class="border-dark">{{ $item->jk }}</td>
                                      @foreach ($months as $date)
                                          @if (Carbon::parse($date)->isoFormat('dddd') == 'Sabtu' || Carbon::parse($date)->isoFormat('dddd') == 'Minggu')
                                              <td class="border-dark bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Libur Hari {{ Carbon::parse($date)->isoFormat('dddd') == 'Sabtu' ? 'Sabtu' : 'Minggu' }}">

                                              </td>
                                          @elseif ($libur->pluck('tgl')->contains($date))
                                              <td class="border-dark bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $libur->where('tgl', $date)->first()->ket }}">

                                              </td>
                                          @elseif ($absen->where('siswa_id', $item->id)->where('tanggal', $date)->count() < 1)
                                              <td class="border-dark text-center align-middle">
                                                  ?
                                              </td>
                                          @else
                                              <td class="border-dark text-center align-middle">
                                                  <span class="badge bg-{{ $absen->where('siswa_id', $item->id)->where('tanggal', $date)->first()->keterangan }}">
                                                    {{ $absen->where('siswa_id', $item->id)->where('tanggal', $date)->first()->keterangan }}
                                                  </span>
                                              </td>
                                          @endif
                                      @endforeach


                                      @php
                                           $H = $absen->where('siswa_id', $item->id)
                                                      ->whereIn('keterangan', ['H'])
                                                      ->where('tanggal', '>=', $months[0])
                                                      ->where('tanggal', '<=', end($months))
                                                      ->whereNotIn('tanggal', $libur->pluck('tgl'))
                                                      ->count();

                                           $S = $absen->where('siswa_id', $item->id)
                                                      ->whereIn('keterangan', ['S'])
                                                      ->where('tanggal', '>=', $months[0])
                                                      ->where('tanggal', '<=', end($months))
                                                      ->whereNotIn('tanggal', $libur->pluck('tgl'))
                                                      ->count();

                                           $I = $absen->where('siswa_id', $item->id)
                                                      ->whereIn('keterangan', ['I'])
                                                      ->where('tanggal', '>=', $months[0])
                                                      ->where('tanggal', '<=', end($months))
                                                      ->whereNotIn('tanggal', $libur->pluck('tgl'))
                                                      ->count();

                                           $A = $absen->where('siswa_id', $item->id)
                                                      ->whereIn('keterangan', ['A'])
                                                      ->where('tanggal', '>=', $months[0])
                                                      ->where('tanggal', '<=', end($months))
                                                      ->whereNotIn('tanggal', $libur->pluck('tgl'))
                                                      ->count();
                                      @endphp

                                      <td class="border-dark text-center">{{ $H > 0 ? $H : '' }}</td>
                                      <td class="border-dark text-center">{{ $S > 0 ? $S : '' }}</td>
                                      <td class="border-dark text-center">{{ $I > 0 ? $I : '' }}</td>
                                      <td class="border-dark text-center">{{ $A > 0 ? $A : '' }}</td>
                                    </tr>
                                @endforeach
                              </tbody>

                            </table>
                          </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
