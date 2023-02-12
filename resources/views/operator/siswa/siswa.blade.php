@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
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
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        {{ $sekolah->nm_sekolah }}
                    </div>
                    <hr class="mb-4">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nama</th>
                                <th>Nisn</th>
                                <th>Tingkat</th>
                                <th>Rombel</th>
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
                "order": [
                    [3, "ASC"],
                    [4, "ASC"],
                    [1, "ASC"]
                ],
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
                        data: 'nisn',
                        name: 'nisn'
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
