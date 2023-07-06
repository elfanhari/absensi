<div class="row">
  <div class="col-md-6">
    <div class="form-group row">
      <label for="abc" class="col-sm-3 col-form-label">Nama Lengkap</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " name="name" id="name" placeholder="Masukkan nama lengkap">
        @error('name')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="abc" class="col-sm-3 col-form-label">Kelas</label>
      <div class="col-sm-8">
        <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" id="exampleSelectBorder">
          <option value="" disabled selected>-- Pilih Kelas --</option>
          @foreach ($kelas as $item)
            <option value="{{ $item->id }}" {{ $item->id == old('kelas_id') ? 'selected' : '' }}>{{ $item->name }}</option>
          @endforeach
        </select>
        @error('kelas_id')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="abc" class="col-sm-3 col-form-label">NIS</label>
      <div class="col-sm-8">
        <input type="text" maxlength="10" value="{{ old('nis') }}" class="form-control @error('nis') is-invalid @enderror " id="nis" name="nis" placeholder="Masukkan NIS">
        @error('nis')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="abc" class="col-sm-3 col-form-label">NISN</label>
      <div class="col-sm-8">
        <input type="text" maxlength="10" value="{{ old('nisn') }}" class="form-control @error('nisn') is-invalid @enderror " id="nisn" name="nisn" placeholder="Masukkan NISN">
        @error('nisn')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="abc" class="col-sm-3 col-form-label">Jenis Kelamin</label>
      <div class="col-sm-8">
        <select class="form-select @error('jk') is-invalid @enderror" name="jk" id="">
          <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
          <option value="L" {{ 'L' == old('jk') ? 'selected' : '' }}>Laki-laki</option>
          <option value="P" {{ 'P' == old('jk') ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jk')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="abc" class="col-sm-3 col-form-label">Telepon <small>(Opsional)</small></label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('telepon') }}" class="form-control @error('telepon') is-invalid @enderror " name="telepon" placeholder="Masukkan telepon">
        @error('telepon')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="abc" class="col-sm-3 col-form-label">Alamat<small> (Opsional)</small></label>
      <div class="col-sm-8">
        <textarea type="text" class="form-control @error('alamat') is-invalid @enderror " name="alamat" placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
        @error('alamat')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group row">
      <label for="username" class="col-sm-3 col-form-label">Username</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror " name="username" placeholder="Masukkan username">
        @error('username')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="password" class="col-sm-3 col-form-label">Password</label>
      <div class="col-sm-8">
        <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" placeholder="Masukkan password">
        @error('password')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <input type="hidden" name="user_id" id="" value="1">

  </div>
</div>

<div class="row">
  <div class="col-md-6 offset-md-6">
    <div class="form-group row">
      <div class="offset-sm-9 col-sm-3">
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </div>
  </div>
</div>
