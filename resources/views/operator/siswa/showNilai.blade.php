@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if ($message = Session::get('message'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="card-body">
                    <div class="card-title">
                        {{ $sma->nm_sekolah }}
                    </div>
                    <hr class="mb-4">
                    <a href="/op/siswa/import">
                        <button type="button" class="btn btn-sm btn-success text-white float-end mb-3 ms-2">
                            <span class="fa fa-file"></span> Upload Nilai
                        </button>
                    </a>
                    <a href="{{ url('/op/export') }}">
                        <button type="button" class="btn btn-sm btn-primary float-end mb-3 ms-2">
                            <span class="fa fa-file"></span> Download Tempate
                        </button>
                    </a>
                    <a href="{{ url('/op/export/smp') }}">
                        <button type="button" class="btn btn-sm btn-default float-end mb-3 ms-2">
                            <span class="fa fa-file"> </span> Download NPSN SMP
                        </button>
                    </a>
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nama</th>
                                <th>Nisn</th>
                                <th>Nilai</th>
                                <th>npsn</th>
                                <th>npsn smp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($smas as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->siswas->nama }}</td>
                                    <td>{{ $data->siswas->nisn }}</td>
                                    <td>{{ $data->rerata }}</td>
                                    <td>{{ $data->smas->nm_sekolah }}</td>
                                    <td>
                                        @if ($data->npsn_smp)
                                            {{ $data->smps->nama_smp }}
                                        @else
                                            <span class="badge bg-pill bg-danger"> SMP TIDAK DI TEMUKAN</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
