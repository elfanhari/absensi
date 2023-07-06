<div class="row">
  <div class="col-md-6">
    <div class="form-group row">
      <label for="kelas_id" class="col-sm-4 col-form-label">Nama Pembelajaran</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" value="{{ $pembelajaran->mapel->name }} - {{ $pembelajaran->kelas->name }}" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="guru_id" class="col-sm-4 col-form-label">Guru Pengampu</label>
      <div class="col-sm-8">
        <select class="form-select @error('guru_id') is-invalid @enderror" name="guru_id" id="exampleSelectBorder">
          <option value="" disabled selected>-- Pilih Guru --</option>
          @foreach ($guru as $item)
          <option value="{{ $item->id }}" {{ $item->id == old('guru_id', $pembelajaran->guru_id) ? 'selected' : ''}}>{{ $item->name }}{{ $item->gelar ? ', ' . $item->gelar : '' }}</option>
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
          <input type="checkbox" required> Saya yakin akan mengubah data tersebut
        </label>
      </div>
    </div>
    <div class="offset-sm-4 col-sm-8 mt-2">
      <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</div>
