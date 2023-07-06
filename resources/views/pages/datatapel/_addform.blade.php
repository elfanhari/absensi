<div class="row">
  <div class="col">
    <div class="form-group row">
      <label for="tahun_pelajaran" class="col-sm-5 col-form-label">Tahun Pelajaran</label>
      <div class="col-sm-7">
        <input type="text" value="{{ old('tahun_pelajaran') }}" class="form-control @error('tahun_pelajaran') is-invalid @enderror " name="tahun_pelajaran" id="" placeholder="Masukkan Tahun Pelajaran" required>
        @error('tahun_pelajaran')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="semester" class="col-sm-5 col-form-label">Semester</label>
      <div class="col-sm-7">
        <select class="form-select @error('semester') is-invalid @enderror" name="semester" id="exampleSelectBorder" required>
          <option value="" disabled selected>-- Pilih Semester --</option>
          <option value="1" {{ '1' == old('semester') ? 'selected' : ''}}>Ganjil</option>
          <option value="2" {{ '2' == old('semester') ? 'selected' : ''}}>Genap</option>
        </select>
        @error('semester')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
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
