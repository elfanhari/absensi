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
                        <a href="{{ route('absensi.index', auth()->user()->role) }}" class="btn btn-sm btn-link p-0 me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                                class="bi fw-bold bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg>
                        </a>
                        Absensi: {{ $pembelajaran->kelas->name }}
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
                    @if ($pertemuan->count() < 1)

                        @if ($role == 'siswa')
                            <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                                <div class="d-flex align-items-center">
                                  <div class="me-2">
                                    @include('_failed')
                                  </div>
                                  <div class="">
                                    Belum ada pertemuan di Pembelajaran ini! Silahkan hubungi <b> Guru pengampu </b>
                                  </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                                <div class="d-flex align-items-center">
                                  <div class="me-2">
                                    @include('_failed')
                                  </div>
                                  <div class="">
                                    Belum ada pertemuan di Pembelajaran ini! Silahkan klik <b>Tambah Pertemuan</b> untuk mengelola absensi!
                                  </div>
                                </div>
                            </div>
                        @endif
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
                                <div class="row col-6">
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
                                        : {{ $pembelajaran->kelas->name }}
                                    </div>
                                    <div class="col-md-4 fw-bold">
                                        Guru Pengampu
                                    </div>
                                    <div class="col-md-8">
                                        : {{ $pembelajaran->guru->name }}
                                    </div>
                                    <div class="col-md-4 fw-bold">
                                        Tahun Pelajaran
                                    </div>
                                    <div class="col-md-8">
                                        : {{ $pembelajaran->kelas->tapel->tahun_pelajaran }} - Semester
                                        {{ $pembelajaran->kelas->tapel->semester }}
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                                <div class="table-responsive">
                                    <table

                                    @if ($role != 'siswa')
                                      id="table1"
                                    @endif

                                        class="table table-sm table-striped table-hover table-bordered border-dark">

                                        @if ($role != 'siswa')
                                            <a href="{{ route('absensi.create', $role) }}"
                                                class="btn btn-sm float-left btn-primary btn-icon-split float-right mt-1 ms-3"
                                                data-bs-toggle="modal" data-bs-placement="right" title="Tambah Pertemuan"
                                                data-bs-target="#tambahPertemuan">
                                                <span class="icon text-white-30 pe-1 pb-1 pt-0"
                                                    style="padding-top: 0.20rem !important;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                        <path
                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                    </svg>
                                                </span>
                                                <span class="text">Pertemuan</span>
                                            </a>

                                            @if ($pertemuan->count() >= 1)
                                            {{-- <form action="{{ route('rekapabsensi.print', ['role' => auth()->user()->role, 'id' => $pembelajaran->id]) }}" method="get" target="_blank"> --}}
                                              {{-- @csrf --}}
                                                <a href="{{ route('rekapabsensi.print', ['role' => auth()->user()->role, 'id' => $pembelajaran->id]) }}" target="_blank" class="btn btn-success btn-sm mb-3">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill me-1" viewBox="0 0 16 16">
                                                    <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                                    <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                  </svg>
                                                  Cetak Rekapitulasi</a>
                                              {{-- </form> --}}
                                            @endif
                                          @endif
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

                                                @if ($pertemuan->count() >= 1)
                                                <th scope="col" colspan="{{ count($pertemuan) }}"
                                                    class="bg-info text-center border-dark">
                                                    Pertemuan Ke</th>
                                                <th scope="col" colspan="5" class="bg-info text-center border-dark">
                                                    Jumlah</th>
                                                @endif
                                            </tr>
                                            <tr class="bg-secondary">

                                              @if ($pertemuan->count() >= 1)
                                                @foreach ($pertemuan as $pert)
                                                    <th scope="col" class="border-dark"
                                                     data-bs-toggle="modal"
                                                    @if ($role != 'siswa')
                                                        data-bs-placement="top" title="Klik untuk detail">
                                                        <div class=""
                                                          data-bs-target="#detailPertemuan/{{ $pert->id }}"
                                                            data-bs-toggle="modal"
                                                        @endif
                                                            >
                                                            <div class="text-center align-middle fw-bold">{{ $pert->pertemuan_ke }}
                                                            </div>

                                                        </div>
                                                    </th>

                                                    <div class="">
                                                     {{-- Modal Detail --}}
                                                    <div class="modal fade" id="detailPertemuan/{{ $pert->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">Detail Pertemuan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">

                                                            <div class="callout callout-warning my-1">
                                                              <div class="row">
                                                                  <div class="col-4 fw-bold">
                                                                      Pembelajaran:
                                                                  </div>
                                                                  <div class="col-8">
                                                                      : {{ $pembelajaran->mapel->singkatan }}
                                                                      - {{ $pembelajaran->kelas->name }}
                                                                  </div>
                                                                  <div class="col-4 fw-bold">
                                                                      Pertemuan Ke:
                                                                  </div>
                                                                  <div class="col-8">
                                                                      : {{ $pert->pertemuan_ke }}
                                                                  </div>
                                                                  <div class="col-4 fw-bold">
                                                                      Hari, Tanggal
                                                                  </div>
                                                                  <div class="col-8">
                                                                      :
                                                                      {{ Carbon::parse($pert->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                                                                  </div>
                                                                  <div class="col-4 fw-bold">
                                                                      Pukul
                                                                  </div>
                                                                  <div class="col-8">
                                                                      : {{ Carbon::parse($pert->dari_pukul)->format('H:i') }} s/d
                                                                      {{ Carbon::parse($pert->sampai_pukul)->format('H:i') }}
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          </div>
                                                          <div class="modal-footer justify-content-between">
                                                            <button class="btn btn-danger btn-sm" data-bs-target="#hapusPertemuan{{ $pert->id }}" data-bs-toggle="modal">Hapus Pertemuan</button>
                                                            <button class="btn btn-warning btn-sm" data-bs-target="#editPertemuan/{{ $pert->id }}" data-bs-toggle="modal">Edit Pertemuan</button>
                                                                  <a href="{{ route('kelolaabsensi.edit', ['id' => $pert->id, 'role' => auth()->user()->role]) }}"
                                                                        class="btn btn-primary btn-sm text-white">Kelola
                                                                        Absen
                                                                  </a>

                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>

                                                    {{-- Modal Hapus --}}
                                                    <div class="modal fade" id="hapusPertemuan{{ $pert->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">

                                                          <div class="callout callout-warning my-1">
                                                              <div class="row">
                                                                  <div class="col-4 fw-bold">
                                                                      Pembelajaran:
                                                                  </div>
                                                                  <div class="col-8">
                                                                      : {{ $pembelajaran->mapel->name }}
                                                                      - {{ $pembelajaran->kelas->name }}
                                                                  </div>
                                                                  <div class="col-4 fw-bold">
                                                                      Pertemuan Ke:
                                                                  </div>
                                                                  <div class="col-8">
                                                                      : {{ $pert->pertemuan_ke }}
                                                                  </div>
                                                                  <div class="col-4 fw-bold">
                                                                      Hari, Tanggal
                                                                  </div>
                                                                  <div class="col-8">
                                                                      :
                                                                      {{ Carbon::parse($pert->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                                                                  </div>
                                                                  <div class="col-4 fw-bold">
                                                                      Pukul
                                                                  </div>
                                                                  <div class="col-8">
                                                                      : {{ Carbon::parse($pert->dari_pukul)->format('H:i') }} s/d
                                                                      {{ Carbon::parse($pert->sampai_pukul)->format('H:i') }}
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          <p class="mt-3 mb-0"> Apakah anda yakin akan menghapus pertemuan tersebut? </p>

                                                          </div>
                                                          <div class="modal-footer">
                                                            <form action="{{ route('absensi.destroy', ['absensi' => $pert->id, 'role' => $role] ) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                              <input type="hidden" name="pertemuan_ke" id="" value="{{ $pert->pertemuan_ke }}" hidden>
                                                              <button type="button" class="btn btn-secondary btn-sm"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                              <button type="submit" class="btn btn-danger btn-sm">Yakin, Hapus</button>
                                                            </form>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>

                                                    {{-- Edit Pertemuan --}}
                                                    <div class="modal fade" id="editPertemuan/{{ $pert->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog modal-lg">

                                                          <form action="{{ route('absensi.update', ['absensi' => $pert->id, 'role' => $role] ) }}" method="POST">
                                                              @csrf
                                                              @method('PUT')

                                                              <div class="modal-content">
                                                                  <div class="modal-header">
                                                                      <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">Edit Pertemuan
                                                                      </h5>
                                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                      @include('pages.absensi._editform')
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                      <button type="submit" class="btn mb-0 btn-primary">Simpan</button>
                                                                  </div>
                                                              </div>

                                                          </form>

                                                      </div>
                                                    </div>

                                                  </div>

                                                @endforeach
                                                <th class="bg-success border-dark align-middle text-center" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Hadir">
                                                  H
                                                </th>
                                                <th class="bg-primary border-dark align-middle text-center" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Sakit">
                                                  S
                                                </th>
                                                <th class="bg-purple border-dark align-middle text-center" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Izin">
                                                  I
                                                </th>
                                                <th class="bg-danger border-dark align-middle text-center" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Alpa">
                                                  A
                                                </th>
                                                <th class="bg-warning border-dark align-middle text-center" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Terlambat">
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
                                                    <td class="border-dark">{{ $item->jk }}</td>

                                                  @if ($pertemuan->count() >= 1)

                                                    @foreach ($pertemuan as $pert)
                                                        <td class="border-dark">
                                                            @if ($item->absen->where('siswa_id', $item->id)->where('pertemuan_id', $pert->id)->count() < 1)
                                                                <span class="badge bg-secondary px-2">Belum <br> Diinput</span>
                                                            @else
                                                              @if ( $item->absen->where('siswa_id', $item->id)->where('pertemuan_id', $pert->id)->first()->keterangan == 'H')
                                                                <span class="badge bg-green">
                                                                  H
                                                                </span>
                                                              @elseif ( $item->absen->where('siswa_id', $item->id)->where('pertemuan_id', $pert->id)->first()->keterangan == 'S')
                                                                <span class="badge bg-primary">
                                                                  S
                                                                </span>
                                                              @elseif ( $item->absen->where('siswa_id', $item->id)->where('pertemuan_id', $pert->id)->first()->keterangan == 'I')
                                                                <span class="badge bg-purple">
                                                                  I
                                                                </span>
                                                              @elseif ( $item->absen->where('siswa_id', $item->id)->where('pertemuan_id', $pert->id)->first()->keterangan == 'A')
                                                                <span class="badge bg-danger">
                                                                  A
                                                                </span>
                                                              @elseif ( $item->absen->where('siswa_id', $item->id)->where('pertemuan_id', $pert->id)->first()->keterangan == 'T')
                                                                <span class="badge bg-warning">
                                                                  T
                                                                </span>
                                                              @endif
                                                            @endif
                                                        </td>
                                                    @endforeach

                                                    {{-- @foreach ($absen as $abs) --}}
                                                    <td class="border-dark">
                                                        {{ $item->absen->where('keterangan', 'H')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() < 1 ? '' : $item->absen->where('keterangan', 'H')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() }}
                                                    </td>
                                                    <td class="border-dark">
                                                        {{ $item->absen->where('keterangan', 'S')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() < 1 ? '' : $item->absen->where('keterangan', 'S')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() }}
                                                    </td>
                                                    <td class="border-dark">
                                                        {{ $item->absen->where('keterangan', 'I')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() < 1 ? '' : $item->absen->where('keterangan', 'I')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() }}
                                                    </td>
                                                    <td class="border-dark">
                                                        {{ $item->absen->where('keterangan', 'A')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() < 1 ? '' : $item->absen->where('keterangan', 'A')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() }}
                                                    </td>
                                                    <td class="border-dark">
                                                        {{ $item->absen->where('keterangan', 'T')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() < 1 ? '' : $item->absen->where('keterangan', 'T')->whereIn('pertemuan_id', $pertemuan->pluck('id'))->count() }}
                                                    </td>
                                                    {{-- @endforeach --}}

                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            {{-- @endif --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="tambahPertemuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <form action="{{ route('absensi.store', $role) }}" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">Tambah Pertemuan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('pages.absensi._addform')
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn mb-0 btn-primary">Simpan</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    </div>

@endsection
