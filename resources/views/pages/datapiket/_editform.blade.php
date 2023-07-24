<div class="row">
  <div class="col-md-6">
    <div class="form-group row">
      <label for="abc" class="col-sm-4 col-form-label">Nama</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('name', $piket->name ) }}" class="form-control @error('name') is-invalid @enderror " name="name" id="name" placeholder="Masukkan nama lengkap">
        @error('name')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="is_aktif" class="col-sm-4 col-form-label">Status Piket</label>
      <div class="col-sm-8">
        <select class="form-select form-control @error('is_aktif') is-invalid @enderror" name="is_aktif" id="">
          <option value="" disabled selected>-- Pilih Status --</option>
          <option value="1" {{ $piket->user->is_aktif == '1' ? 'selected' : '' }}>Aktif</option>
          <option value="0" {{ $piket->user->is_aktif == '0' ? 'selected' : '' }}>Non-Aktif</option>
        </select>
        @error('is_aktif')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="username" class="col-sm-4 col-form-label">Username</label>
      <div class="col-sm-8">
          <input type="text" value="{{ old('username', $piket->user->username) }}"
              class="form-control @error('username') is-invalid @enderror " name="username"
              placeholder="Masukkan username">
          @error('username')
              <span class="invalid-feedback mt-1">
                  {{ $message }}
              </span>
          @enderror
      </div>
  </div>
  <div class="form-group row">
      <label for="password" class="col-sm-4 col-form-label">Password <small><i>(Opsional)</i></small></label>
      <div class="col-sm-8">
          <input type="password" class="form-control @error('password') is-invalid @enderror " name="password"
              placeholder="Masukkan password">
          @error('password')
              <span class="invalid-feedback mt-1">
                  {{ $message }}
              </span>
          @enderror
      </div>
  </div>
    <div class="offset-sm-4 col-sm-8 mt-4">
      <div class="checkbox">
        <label>
          <input type="checkbox" required> Saya yakin akan mengubah data tersebut
        </label>
      </div>
    </div>
    <div class="offset-sm-4 col-sm-8 mt-2">
      <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</div>
