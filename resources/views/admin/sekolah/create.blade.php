
    <div class="form-group">
        <label for="">Kab Kota</label>
        <select class="form-control" id="kab_kota">
            <option value="">--</option>
            @foreach ($kabs as $data)
                <option value="{{ $data->id }}">{{ $data->kab_kota }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">NPSN SEKOLAH</label>
        <input type="text" class="form-control" id="npsn" required>
    </div>
    <div class="form-group">
        <label for="">NAMA SEKOLAH</label>
        <input type="text" class="form-control" required id="nama">
    </div>
    <div class="form-group">
        <label for="">JENJANG</label>
        <select class="form-control" required id="jenjang">
            <option value="">--</option>
            <option value="SMA">SMA</option>
            <option value="SMK">SMK</option>
        </select>
    </div>
    <button class="btn btn-primary" type="button" onclick="simpan()">Simpan</button>
    <button class="btn btn-default" type="button" onclick="batal()">Batal</button>
