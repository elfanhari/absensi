<div class="row">
  <div class="col">
    <div class="form-group row">
      <label for="tahun_pelajaran" class="col-sm-5 col-form-label">Tahun Pelajaran</label>
      <div class="col-sm-7">
        <div class="row">
          <div class="col-5">
            <input type="number" value="{{ old('tapel1') }}" class="form-control @error('tapel1') is-invalid @enderror " name="tapel1" id="" placeholder="20xx" required>
            @error('tapel1')
            <span class="invalid-feedback mt-1">
              {{ $message }}
            </span>
            @enderror
          </div>
          <div class="col-2 text-center align-middle">
            <h5>/</h5>
          </div>
          <div class="col-5">
            <input type="number" value="{{ old('tapel2') }}" class="form-control @error('tapel2') is-invalid @enderror " name="tapel2" id="" placeholder="20xx" required>
            @error('tapel2')
            <span class="invalid-feedback mt-1">
              {{ $message }}
            </span>
            @enderror
          </div>
        </div>
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
