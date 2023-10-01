@php

    use App\Models\User;
    use Carbon\Carbon;

    $user = Auth::user();
    $admin = Auth::user()->admin;
    $guru = Auth::user()->guru;
    $siswa = Auth::user()->siswa;
    $piket = Auth::user()->piket;

    // $getUser = User::getUser()->name;

    if ($admin) {
        $userLogin = $admin;
    } elseif ($guru) {
        $userLogin = $guru;
    } elseif ($siswa) {
        $userLogin = $siswa;
    } elseif ($piket) {
        $userLogin = $piket;
    }

    $role = auth()->user()->role;

@endphp

@extends('layouts.main')

@section('content')
<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-1">
          <div class="col-sm-6">
              <h4 class="fw-bold poppins m-0">Profil Saya</h4>
          </div>
          <div class="col-sm-6 mt-xs-2">
              @if (session()->has('success'))
                  <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                      @include('_success')
                      {{ session('success') }}
                  </div>
              @endif
          </div>
      </div>
  </div>
</div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-outline">
                        <div class="card-body box-profile mt-3">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle img-profile" src="/img/{{ $user->foto ?? 'profile.jpg' }}"
                                    alt="User profile picture">
                            </div>

                            <h5 class="text-center fw-bold mt-3">
                                {{ $userLogin->name }}
                            </h4>

                            <p class="text-muted text-center text-capitalize">
                                {{ $user->role }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right text-secondary">
                                        {{ Auth::user()->username }}
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right text-secondary">
                                        {{ Auth::user()->email }}
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Role</b> <a class="float-right text-secondary">
                                        @if ($admin)
                                            Administrator
                                        @elseif($guru)
                                            Guru
                                        @elseif($piket)
                                            Piket
                                        @elseif($siswa)
                                            Siswa - {{ $siswa->kelas->name }}
                                        @endif
                                </a>
                                </li>
                            </ul>

                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-mine">
                                <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Edit
                                        Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#foto" data-toggle="tab">Edit Foto</a></li>
                                <li class="nav-item"><a class="nav-link" href="#akun" data-toggle="tab">Edit Akun</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profil">
                                    <form class="form-horizontal"
                                        action="{{ route('profil.update', $userLogin->user_id) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    placeholder="Maukkan nama lengkap" value="{{ $userLogin->name }}"
                                                    {{ $role == 'siswa' ? 'readonly' : '' }}>
                                                @error('name')
                                                    <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        @if ($role == 'siswa')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">NIS</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name=""
                                                        class="form-control @error('nis') is-invalid @enderror"
                                                        id="nip" placeholder="NIS" value="{{ $userLogin->nis }}"
                                                        readonly>
                                                    @error('nis')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">NISN</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name=""
                                                        class="form-control @error('nisn') is-invalid @enderror"
                                                        id="nuptk" placeholder="NISN" value="{{ $userLogin->nisn }}"
                                                        readonly>
                                                    @error('nisn')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        @if (Auth::user()->role != 'piket')
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-9">
                                                <select class="form-select @error('jk') is-invalid @enderror" name="jk"
                                                    id="exampleSelectBorder">

                                                    <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                                                    <option value="L" {{ $userLogin->jk == 'L' ? 'selected' : '' }}>
                                                        Laki-laki</option>
                                                    <option value="P" {{ $userLogin->jk == 'P' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                                @error('jk')
                                                    <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endif

                                        @if ($role == 'admin' || $role == 'guru')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">NIP</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="nip"
                                                        class="form-control @error('nip') is-invalid @enderror"
                                                        id="nip" placeholder="nip" value="{{ $userLogin->nip }}">
                                                    @error('nip')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">NUPTK</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="nuptk"
                                                        class="form-control @error('nuptk') is-invalid @enderror"
                                                        id="nuptk" placeholder="nuptk"
                                                        value="{{ $userLogin->nuptk }}">
                                                    @error('nuptk')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        @if (Auth::user()->role != 'piket')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Telepon</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="telepon"
                                                        class="form-control @error('telepon') is-invalid @enderror"
                                                        id="telepon" placeholder="telepon"
                                                        value="{{ $userLogin->telepon }}">
                                                    @error('telepon')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputExperience"
                                                    class="col-sm-3 col-form-label">Alamat</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="inputExperience"
                                                        placeholder="Masukkan alamat">{{ $userLogin->alamat }}</textarea>
                                                    @error('alamat')
                                                        <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif

                                        <input type="hidden" name="user_id" id=""
                                            value="{{ $user->id }}" hidden>

                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" required> Saya yakin akan mengubah data
                                                        tersebut
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- FOTO --}}
                                <div class="tab-pane" id="foto">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-borderless mt-xs-2">

                                                    <tr class="text-center text-bold">
                                                        <td>Foto</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center"><img src="/img/{{ $user->foto }}"
                                                                alt=""
                                                                class="rounded-circle img-profile"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <small class="fs-12"> <i>Ganti foto user</i></small>
                                            <form action="{{ route('foto.update', $user->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="old_foto" id=""
                                                    value="{{ $user->foto }}" hidden>

                                                <div class="">
                                                    <div class="my-2 position-relative">
                                                        <img class="img-preview img-fluid mb-2 col-sm-6 rounded-circle oferflow-y-hidden"
                                                            style="max-width: 200px;">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" name="user_id"
                                                            value="{{ $user->id }}">
                                                        <input type="file" accept="image/*"
                                                            class="form-control @error('files') is-invalid @enderror"
                                                            name="files" id="gambar" onchange="previewImage()">
                                                        <button type="submit" class="input-group-text btn-primary"
                                                            for="inputGroupFile02">Update</button>
                                                        @error('files')
                                                            <span class="invalid-feedback mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                </div>

                                {{-- AKUN --}}
                                <div class="tab-pane " id="akun">
                                    <form class="form-horizontal"
                                        action="{{ route('akunsaya.update', $user->id) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    value="{{ old('username', $user->username) }}"
                                                    class="form-control @error('username') is-invalid @enderror "
                                                    name="username" placeholder="Masukkan username">
                                                @error('username')
                                                    <span class="invalid-feedback mt-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 col-form-label">Email
                                                <small>(Opsional)</small> </label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{ old('email', $user->email) }}"
                                                    class="form-control @error('email') is-invalid @enderror "
                                                    name="email" placeholder="Masukkan email">
                                                @error('email')
                                                    <span class="invalid-feedback mt-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">Password
                                                <small>(opsional)</small></label>
                                            <div class="col-sm-9">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror "
                                                    name="password" placeholder="Masukkan password baru">
                                                @error('password')
                                                    <span class="invalid-feedback mt-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="offset-sm-3 col-sm-8 mt-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" required> Saya yakin akan mengubah data tersebut
                                                </label>
                                            </div>
                                        </div>
                                        <div class="offset-sm-3 col-sm-8 mt-2">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>


                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>

        </div>
    </section>

    <script>
        function previewImage() {
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(gambar.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
