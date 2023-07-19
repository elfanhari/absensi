<div class="row">
  <div class="col">
    <div class="form-group row">
      <label for="penerima_id" class="col-sm-3 col-form-label">Kirim Ke:</label>
      <div class="col-sm-9">
        <select class="form-select form-control @error('penerima_id') is-invalid @enderror" name="penerima_id" id="exampleSelectBorder">
          <option value="" disabled selected>-- Pilih --</option>
          @foreach ($siswa as $item)
            <option value="{{ $item->user->id }}" {{ $item->id == old('penerima_id') ? 'selected' : ''}}>{{ $item->name . ' - ' . $item->kelas->name}} (Siswa)</option>
          @endforeach
          @foreach ($guru as $item)
            <option value="{{ $item->user->id }}" {{ $item->id == old('penerima_id') ? 'selected' : ''}}>{{ $item->name}} (Guru)</option>
          @endforeach
          @foreach ($admin as $item)
            <option value="{{ $item->user->id }}" {{ $item->id == old('penerima_id') ? 'selected' : ''}}>{{ $item->name}} (Admin)</option>
          @endforeach
        </select>
        @error('penerima_id')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="kategori" class="col-sm-3 col-form-label">Jenis Notifikasi</label>
      <div class="col-sm-9">
        <select class="form-select form-control @error('kategori') is-invalid @enderror" name="kategori" id="">
          <option value="" disabled selected>-- Pilih --</option>
          <option value="Peringatan" {{ 'Peringatan' == old('kategori') ? 'selected' : '' }}>Peringatan</option>
          <option value="Informasi" {{ 'Informasi' == old('kategori') ? 'selected' : '' }}>Informasi</option>
        </select>
        @error('kategori')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="judul" class="col-sm-3 col-form-label">Judul</label>
      <div class="col-sm-9">
        <input type="text" value="{{ old('judul') }}" class="form-control @error('judul') is-invalid @enderror " name="judul" id="judul" placeholder="Masukkan judul notifikasi">
        @error('judul')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="isi" class="col-sm-3 col-form-label">Isi</label>
      <div class="col-sm-9">
        <textarea type="text" class="form-control @error('isi') is-invalid @enderror " name="isi" placeholder="Masukkan isi">{{ old('isi') }}</textarea>
        @error('isi')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="offset-sm-3 col-sm-9 my-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" required> Saya yakin sudah mengisi dengan benar
        </label>
      </div>
    </div>
</div>
