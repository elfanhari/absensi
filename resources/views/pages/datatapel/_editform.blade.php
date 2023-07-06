<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="tahun_pelajaran" class="col-sm-5 col-form-label">Tahun Pelajaran</label>
            <div class="col-sm-7">
                <input type="text" value="{{ old('tahun_pelajaran', $tapel->tahun_pelajaran) }}"
                    class="form-control @error('tahun_pelajaran') is-invalid @enderror " name="tahun_pelajaran"
                    id="" placeholder="Masukkan Tahun Pelajaran" required readonly>
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
                <select class="form-select @error('semester') is-invalid @enderror" name="semester"
                    id="exampleSelectBorder" required disabled>
                    <option value="" disabled selected>-- Pilih Semester --</option>
                    <option value="1" {{ '1' == old('semester', $tapel->semester) ? 'selected' : '' }}>Ganjil</option>
                    <option value="2" {{ '2' == old('semester', $tapel->semester) ? 'selected' : '' }}>Genap</option>
                </select>
                @error('semester')
                    <span class="invalid-feedback mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="offset-sm-5 col-sm-7 mt-4">
          <div class="checkbox">
            <label>
              <input type="checkbox" required> Saya yakin akan mengubah data tersebut
            </label>
          </div>
        </div>
        <div class="offset-sm-5 col-sm-7 mt-2">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
</div>
