<div class="row">
  <div class="col">
    <div class="form-group row">
      <label for="abc" class="col-sm-3 col-form-label">Nama Pembelajaran</label>
      <div class="col-sm-9">
        <input type="text" value="{{ $pembelajaran->mapel->name . ' - ' . $pembelajaran->kelas->name}}" class="form-control @error('abc') is-invalid @enderror " name="abc" id="" placeholder="" disabled readonly >
      </div>
    </div>
    <div class="form-group row">
      <label for="pertemuan_ke" class="col-sm-3 col-form-label">Pertemuan Ke <small><i>(Angka)</i></small></label>
      <div class="col-sm-9">
        <input type="number" value="{{ old('pertemuan_ke', $pert->pertemuan_ke) }}" class="form-control @error('pertemuan_ke') is-invalid @enderror " name="pertemuan_ke" id="" placeholder="Masukkan pertemuan ke" required>
        @error('pertemuan_ke')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
      <div class="col-sm-9">
        <input type="date" value="{{ old('tanggal', $pert->tanggal) }}" class="form-control @error('tanggal') is-invalid @enderror " name="tanggal" id="" placeholder="Pertemuan Ke" required>
        @error('tanggal')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="dari_pukul" class="col-sm-3 col-form-label">Pukul</label>
      <div class="col-sm-4">
        <input type="time" value="{{ old('dari_pukul', $pert->dari_pukul) }}" class="form-control @error('dari_pukul') is-invalid @enderror " name="dari_pukul" id="" placeholder="Pertemuan Ke" required>
        @error('dari_pukul')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
      <div class="col-sm-1 mt-1 text-center">s/d</div>
      <div class="col-sm-4">
        <input type="time" value="{{ old('sampai_pukul', $pert->sampai_pukul) }}" class="form-control @error('sampai_pukul') is-invalid @enderror " name="sampai_pukul" id="" placeholder="Pertemuan Ke" required>
        @error('sampai_pukul')
        <span class="invalid-feedback mt-1">
          {{ $message }}
        </span>
        @enderror
      </div>
    </div>

    <input type="hidden" name="pembelajaran_id" id="" value="{{ $pembelajaran->id }}" hidden>

    <div class="col-sm-9 offset-sm-3">
      <div class="checkbox">
        <label>
          <input type="checkbox" required> Saya yakin sudah mengisi dengan benar
        </label>
      </div>
    </div>
</div>
