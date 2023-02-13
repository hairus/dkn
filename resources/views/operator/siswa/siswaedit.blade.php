<div class="form-group">
    <label for="">Nama</label>
    <input type="text" name="nama" disabled value="{{ $data_pokok->nama }}" class="form-control">
    <input type="hidden" id="id" disabled value="{{ $data_pokok->id }}" class="form-control">
</div>
<div class="form-gorup mb-2">
    <label for="">Nisn</label>
    <input type="text" name="nisn" id="nisn" value="{{ $data_pokok->nisn }}" class="form-control">
</div>
<div class="form-gorup">
    <label for="">Rombel</label>
    <input type="text" name="rombel" id="rombel" value="{{ $data_pokok->rombel }}" class="form-control">
</div>
