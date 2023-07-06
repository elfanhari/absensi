<div class="row">
  <div class="col-md-6">
    <div class="form-group row">
      <label for="kelas_id" class="col-sm-4 col-form-label">Kelas</label>
      <div class="col-sm-8">
        <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" id="exampleSelectBorder">
          <option value="" disabled selected>-- Pilih Kelas --</option>
          @foreach ($kelas as $item)
            <option value="{{ $item->id }}" {{ $item->id == old('kelas_id') ? 'selected' : ''}}>{{ $item->name }}</option>
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
      <label for="mapel_id" class="col-sm-4 col-form-label">Mapel</label>
      <div class="col-sm-8">
        <select class="form-select @error('mapel_id') is-invalid @enderror" name="mapel_id" id="exampleSelectBorder">
          <option value="" disabled selected>-- Pilih Mapel --</option>
          @foreach ($mapel as $item)
            <option value="{{ $item->id }}" {{ $item->id == old('mapel_id') ? 'selected' : ''}} >{{ $item->name }}</option>
          @endforeach
        </select>
        @error('mapel_id')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="guru_id" class="col-sm-4 col-form-label">Guru Pengampu</label>
      <div class="col-sm-8">
        <select class="form-select @error('guru_id') is-invalid @enderror" name="guru_id" id="exampleSelectBorder">
          <option value="" disabled selected>-- Pilih Guru --</option>
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
