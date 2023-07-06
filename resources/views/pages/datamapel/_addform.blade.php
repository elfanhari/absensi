<div class="row">
  <div class="col-md-6">
    <div class="form-group row">
      <label for="abc" class="col-sm-4 col-form-label">Nama Mapel</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " name="name" id="name" placeholder="Masukkan nama Mapel">
        @error('name')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="singkatan" class="col-sm-4 col-form-label">Singkatan Mapel</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('singkatan') }}" class="form-control @error('singkatan') is-invalid @enderror " name="singkatan" id="" placeholder="Masukkan singkatan Mapel">
        @error('singkatan')
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
      <button type="submit" class="btn btn-success btn-sm">Simpan</button>
    </div>
</div>
