<div class="row">
  <div class="col">
    <div class="form-group row">
      <label for="tgl" class="col-sm-5 col-form-label">Tanggal</label>
      <div class="col-sm-7">
        <div class="row">
          <input type="date" value="{{ old('tgl') }}" class="form-control @error('tgl') is-invalid @enderror "
                  name="tgl" id="tgl" placeholder="Masukkan tanggal">
          @error('tgl')
              <span class="invalid-feedback mt-1">
                  {{ $message }}
              </span>
          @enderror
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="ket" class="col-sm-5 col-form-label">Keterangan</label>
      <div class="col-sm-7">
        <div class="row">
          <input type="text" value="{{ old('ket') }}" class="form-control @error('ket') is-invalid @enderror "
                  name="ket" id="ket" placeholder="Masukkan keterangan">
          @error('ket')
              <span class="invalid-feedback mt-1">
                  {{ $message }}
              </span>
          @enderror
        </div>
      </div>
    </div>
    <div class="">
      <div class="checkbox">
        <label>
          <input type="checkbox" required> Saya yakin sudah mengisi dengan benar
        </label>
      </div>
    </div>
</div>
