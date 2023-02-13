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
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT NISN</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="page"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="store()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#myTable').DataTable({
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
                    {
                        data: 'action',
                    },

                ]
            });
        });

        function edit(id) {
            $.ajax({
                type: 'get',
                url: "/op/siswa/edit/" + id,
                success: function(data) {
                    $('#exampleModal').modal('show');
                    $('#page').html(data)
                }
            });
        }

        function store() {
            var id = $('#id').val();
            var nisn = $('#nisn').val();
            var rombel = $('#rombel').val();
            $.ajax({
                type: 'post',
                url: "{{ url('/op/siswa/storenisn') }}",
                data: {
                    id: id,
                    nisn: nisn,
                    rombel:rombel
                },
                success: function(data) {
                    batal()
                    $('#myTable').DataTable().ajax.reload();
                }
            });
        }

        function batal() {
            $('#exampleModal').modal('hide');
        }
    </script>
@endsection
