@php
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
@endphp

@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-0">
                <div class="col-sm-6">
                    <h4 class="fw-bold poppins m-0">
                        <a href="{{ route('absensi.show', ['role' => auth()->user()->role, 'absensi' => $pertemuan->pembelajaran->id]) }}" class="btn btn-sm btn-link p-0 me-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                                class="bi fw-bold bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg>
                        </a>
                        Kelola Absensi: {{ $pembelajaran->kelas->name }}
                    </h4>
                </div>
                <div class="col-sm-6">
                  @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        @include('_success')
                        {!! session('success') !!}
                    </div>
                  @endif
                  @if (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        @include('_failed')
                        {!! session('failed') !!}
                    </div>
                  @endif
                </div>
            </div>

        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                          <div class="callout callout-warning my-1">
                            <div class="row">
                            <div class="col-md-6">
                              <div class="row">
                              <div class="col-md-4 fw-bold">
                                Mata Pelajaran
                              </div>
                              <div class="col-md-8">
                                : {{ $pembelajaran->mapel->name }}
                              </div>
                              <div class="col-md-4 fw-bold">
                                Kelas
                              </div>
                              <div class="col-md-8">
                               :  {{ $pembelajaran->kelas->name }}
                              </div>
                              <div class="col-md-4 fw-bold">
                                Guru Pengampu
                              </div>
                              <div class="col-md-8">
                               :  {{ $pembelajaran->guru->name }}
                              </div>
                              <div class="col-md-4 fw-bold">
                                Tahun Pelajaran
                              </div>
                              <div class="col-md-8">
                               :  {{ $pembelajaran->kelas->tapel->tahun_pelajaran }} - Semester {{ $pembelajaran->kelas->tapel->semester }}
                              </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                              <div class="col-4 fw-bold">
                                Pertemuan Ke:
                              </div>
                              <div class="col-8">
                                : {{ $pertemuan->pertemuan_ke }}
                              </div>
                              <div class="col-4 fw-bold">
                                Hari, Tanggal
                              </div>
                              <div class="col-8">
                                : {{ Carbon::parse($pertemuan->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                              </div>
                              <div class="col-4 fw-bold">
                                Pukul
                              </div>
                              <div class="col-8">
                               :  {{ Carbon::parse($pertemuan->dari_pukul)->format('H:i') }} s/d {{ Carbon::parse($pertemuan->sampai_pukul)->format('H:i') }}
                              </div>
                            </div>
                          </div>
                          </div>
                          </div>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($siswa->count() < 1)
                                Belum ada Siswa di Kelas Ini!
                            @else
                                <div class="table-responsive">
                                  <form action="{{ route('kelolaabsensi.update', ['id' => $pertemuan->id, 'role' => auth()->user()->role]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <table id="" class="table table-sm table-striped table-hover table-bordered border-dark">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th scope="col" rowspan="2"
                                                    class="border-dark text-center align-middle bg-info">#</th>
                                                <th scope="col" rowspan="2"
                                                    class="border-dark text-center align-middle bg-info">NIS</th>
                                                <th scope="col" rowspan="2"
                                                    class="border-dark text-center align-middle bg-info">Nama Siswa</th>
                                                <th scope="col" rowspan="2"
                                                    class="border-dark text-center align-middle bg-info">L/P</th>
                                                <th scope="col" rowspan="2"
                                                    class="border-dark text-center align-middle bg-info">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($siswa as $index => $item)
                                            <tr>
                                              <td class="border-dark">{{ $loop->iteration }}</td>
                                              <td class="border-dark">{{ $item->nis }}</td>
                                              <td class="border-dark text-uppercase">
                                                <input type="hidden" name="siswa_id[]" value="{{ $item->id }}">
                                                {{ $item->name }}
                                              </td>
                                              <td class="border-dark text-uppercase">
                                                {{ $item->jk }}
                                              </td>
                                              <td class="border-dark">
                                                <select name="keterangan[]" id="" class="form-control form-select">
                                                  <option value="H" @if($absen->where('siswa_id', $item->id)->first()) {{ $absen->where('siswa_id', $item->id)->first()->keterangan == 'H' ? 'selected' : '' }} @endif>Hadir</option>
                                                  <option value="S" @if($absen->where('siswa_id', $item->id)->first()) {{ $absen->where('siswa_id', $item->id)->first()->keterangan == 'S' ? 'selected' : '' }} @endif>Sakit</option>
                                                  <option value="I" @if($absen->where('siswa_id', $item->id)->first()) {{ $absen->where('siswa_id', $item->id)->first()->keterangan == 'I' ? 'selected' : '' }} @endif>Izin</option>
                                                  <option value="A" @if($absen->where('siswa_id', $item->id)->first()) {{ $absen->where('siswa_id', $item->id)->first()->keterangan == 'A' ? 'selected' : '' }} @endif>Alpa</option>
                                                  <option value="T" @if($absen->where('siswa_id', $item->id)->first()) {{ $absen->where('siswa_id', $item->id)->first()->keterangan == 'T' ? 'selected' : '' }} @endif>Terlambat</option>
                                                </select>
                                              </td>
                                            </tr>

                                          @endforeach
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-success float-right">
                                      Simpan
                                  </button>
                                  <div class="checkbox float-right me-3">
                                      <label>
                                          <input type="checkbox" class="mt-3" required>
                                          Saya yakin akan mengubah data tersebut
                                      </label>
                                  </div>
                                  </form>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

@endsection
