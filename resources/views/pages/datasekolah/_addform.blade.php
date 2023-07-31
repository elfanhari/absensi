<div class="row">
  <div class="col">
    <div class="form-group row">
      <label for="name" class="col-sm-4 col-form-label">Nama Sekolah</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " name="name" id="name" placeholder="Masukkan nama sekolah">
        @error('name')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="npsn" class="col-sm-4 col-form-label">NPSN</label>
      <div class="col-sm-8">
        <input type="number" value="{{ old('npsn') }}" class="form-control @error('npsn') is-invalid @enderror " name="npsn" id="npsn" placeholder="Masukkan npsn">
        @error('npsn')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="nss" class="col-sm-4 col-form-label">NSS</label>
      <div class="col-sm-8">
        <input type="number" value="{{ old('nss') }}" class="form-control @error('nss') is-invalid @enderror " name="nss" id="nss" placeholder="Masukkan nss">
        @error('nss')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="abc" class="col-sm-4 col-form-label">Telepon</label>
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
      <label for="email" class="col-sm-4 col-form-label">Email</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror " name="email" placeholder="Masukkan email">
        @error('email')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="website" class="col-sm-4 col-form-label">Website</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('website') }}" class="form-control @error('website') is-invalid @enderror " name="website" id="website" placeholder="Masukkan website">
        @error('website')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="abc" class="col-sm-4 col-form-label">Alamat</label>
      <div class="col-sm-8">
        <textarea type="text" class="form-control @error('alamat') is-invalid @enderror " name="alamat" placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
        @error('alamat')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="kodepos" class="col-sm-4 col-form-label">Kode POS</label>
      <div class="col-sm-8">
        <input type="number" value="{{ old('kodepos') }}" class="form-control @error('kodepos') is-invalid @enderror " name="kodepos" id="kodepos" placeholder="Masukkan kodepos">
        @error('kodepos')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="abc" class="col-sm-4 col-form-label">Kepala Sekolah</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('kepsek') }}" class="form-control @error('kepsek') is-invalid @enderror " name="kepsek" id="kepsek" placeholder="Masukkan nama Kepala Sekolah">
        @error('kepsek')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="nipkepsek" class="col-sm-4 col-form-label">NIP Kepala Sekolah</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('nipkepsek') }}" class="form-control @error('nipkepsek') is-invalid @enderror " name="nipkepsek" id="nipkepsek" placeholder="Masukkan nipkepsek">
        @error('nipkepsek')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="offset-sm-4 col-sm-8 mt-4">
      <div class="checkbox">
        <label>
          <input type="checkbox" required> Saya yakin sudah mengisi dengan benar
        </label>
      </div>
    </div>
    <div class="offset-sm-4 col-sm-8 mt-2">
      <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</div>
