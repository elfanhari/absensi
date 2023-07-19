<div class="row">
  <div class="col-md-6">
    <div class="form-group row">
      <label for="abc" class="col-sm-4 col-form-label">Nama Kelas</label>
      <div class="col-sm-8">
        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " name="name" id="name" placeholder="Masukkan nama kelas">
        @error('name')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="tingkat" class="col-sm-4 col-form-label">Tingkat</label>
      <div class="col-sm-8">
        <select class="form-select @error('tingkat') is-invalid @enderror" name="tingkat" id="">
          <option value="" disabled selected>-- Pilih Tingkat Kelas --</option>
          <option value="7" {{ '7' == old('tingkat') ? 'selected' : '' }}>7 (Tujuh)</option>
          <option value="8" {{ '8' == old('tingkat') ? 'selected' : '' }}>8 (Delapan)</option>
          <option value="9" {{ '9' == old('tingkat') ? 'selected' : '' }}>9 (Sembilan)</option>
        </select>
        @error('tingkat')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="guru_id" class="col-sm-4 col-form-label">Wali Kelas</label>
      <div class="col-sm-8">
        <select class="form-select @error('guru_id') is-invalid @enderror" name="guru_id" id="exampleSelectBorder">
          <option value="" disabled selected>-- Pilih Wali Kelas --</option>
          @foreach ($guru as $item)
            <option value="{{ $item->id }}" {{ $item->id == old('guru_id') ? 'selected' : ''}}>{{ $item->name }}{{ $item->gelar ? ', ' . $item->gelar : '' }}</option>
          @endforeach
        </select>
        @error('guru_id')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="tapel_id" class="col-sm-4 col-form-label">Tahun Pelajaran</label>
      <div class="col-sm-8">
        <select class="form-select @error('tapel_id') is-invalid @enderror" name="tapel_id" id="exampleSelectBorder">
          <option value="" disabled selected>-- Pilih Tapel --</option>
          @foreach ($tapel as $item)
            <option value="{{ $item->id }}" {{ $item->id == old('tapel_id') ? 'selected' : ''}}>{{ $item->tahun_pelajaran }} - {{ $item->semester == 1 ? 'Ganjil' : 'Genap' }}</option>
          @endforeach
        </select>
        @error('tapel_id')
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
