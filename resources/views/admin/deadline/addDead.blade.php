@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/admin/saveDead') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Pilih Kab Kota</label>
                            <select name="kab_id" id="" class="form-control" required>
                                    <option value="">Pilih Salah Satu</option>
                                @foreach ($kabs as $kab)
                                    <option value="{{ $kab->id }}">{{ $kab->kab_kota }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label>Batas Akhir / Deadline</label>
                        <div class="input-group mb-3">
                            <input type="text" name="date" id="datetimepicker" class="form-control datetimepicker" required>
                            <div class="input-group-append">
                                <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#datetimepicker').mask('0000-00-00 00:00:00', {placeholder: "____-__-__ __:__:__"});
        });
    </script>
@endsection
