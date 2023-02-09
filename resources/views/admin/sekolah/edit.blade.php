
    <div class="form-group">
        <label for="">Kab Kota</label>
        <select class="form-control" id="kab_kota">
            <option value="">--</option>
            @foreach ($kabs as $data)
                <option @if($data->id == $sma->kab_kota) selected @endif  value="{{ $data->id }}">{{ $data->kab_kota }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <input type="hidden" value="{{ $sma->id }}" id="sma_id">
        <label for="">NPSN SEKOLAH</label>
        <input type="text" class="form-control" id="npsn" required value="{{ $sma->npsn }}">
    </div>
    <div class="form-group">
        <label for="">NAMA SEKOLAH</label>
        <input type="text" class="form-control" required id="nama" value="{{ $sma->nm_sekolah }}">
    </div>
    <div class="form-group">
        <label for="">JENJANG</label>
        <select class="form-control" required id="jenjang">
            <option value="">--</option>
            <option value="SMA" @if($sma->jenjang == 'SMA') selected @endif>SMA</option>
            <option value="SMK" @if($sma->jenjang == 'SMK') selected @endif>SMK</option>
        </select>
    </div>
    <button class="btn btn-success" type="button" onclick="update()">Update</button>
    <button class="btn btn-default" type="button" onclick="batal()">Batal</button>
