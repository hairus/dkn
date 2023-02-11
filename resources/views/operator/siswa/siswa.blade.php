@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        {{ $sekolah->nm_sekolah }}
                    </div>
                    <hr class="mb-4">
                    <a href="{{ url('/op/export') }}">
                        <button type="button" class="btn btn-sm btn-primary float-end mb-3 ms-2">
                            <span class="fa fa-file"> Download Tempate</span>
                        </button>
                    </a>
                    <a href="{{ url('/op/export/smp') }}">
                        <button type="button" class="btn btn-sm btn-default float-end mb-3">
                            <span class="fa fa-file"> Download Master SMP</span>
                        </button>
                    </a>
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nama</th>
                                <th>Rombel</th>
                                <th>Tingkat</th>
                            </tr>
                        </thead>
                        <tbody>

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
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/op/getSiswa') }}",
                    type: "get",
                },
                lengthMenu: [10, 20, 50, 100, 200, 500, 1000],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tingkat',
                        name: 'tingkat'
                    },
                    {
                        data: 'rombel',
                        name: 'rombel'
                    },
                ]
            });
        });
    </script>
@endsection
