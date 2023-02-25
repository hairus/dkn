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
                    @if (auth()->user()->fds->final == false)
                        <button type="button" onclick="showModal()"
                            class="btn btn-sm btn-success text-white float-end mb-3 ms-2">
                            <span class="fa fa-plus"></span> Tambah Siswa
                        </button>
                        <a href="{{ url('/op/export2') }}">
                            <button type="button" class="btn btn-sm btn-primary text-white float-end mb-3 ms-2">
                                <span class="fa fa-plus"></span> Download Siswa
                            </button>
                        </a>
                    @endif
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA</th>
                                <th>NISN</th>
                                <th>TINGKAT</th>
                                <th>ROMBEL</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- modal add --}}
        <div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModaladdLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModaladdLabel">ADD SISWA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="">NISN</label>
                            <input type="text" class="form-control" maxlength="10" name="nisn" id="nisn"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">NPSN SMA</label>
                            <input type="text" class="form-control" name="npsn" readonly
                                value="{{ auth()->user()->npsn }}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="">SMP ASAL</label>
                            <select name="smp" id="smp" class="form-select" style="width: 100%" required>
                                <option value="">--</option>
                                @foreach ($smp as $data)
                                    <option value="{{ $data->nama_smp }}">{{ $data->nama_smp }} - {{ $data->npsn_smp }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="">Rombel</label>
                            <input type="text" class="form-control" name="rombela" id="rombel" placeholder="X MIPA 1"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">Tingkat</label>
                            <select name="" id="tingkat" class="form-control" required>
                                <option value="">---</option>
                                <option value="Kelas 10">Kelas 10</option>
                                <option value="Kelas 11">Kelas 11</option>
                                <option value="Kelas 12">Kelas 12</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="add()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal edit --}}
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
                lengthMenu: [10, 20, 50, 100, 200, 500, 1000],
                "order": [
                    [3, "ASC"],
                    [4, "ASC"],
                    [1, "ASC"]
                ],
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
            $('#smp').select2({
                dropdownParent: $("#exampleModaladd")
            });
        });

        function add() {
            var nama = $('#nama').val();
            var nisn = $('#nisn').val();
            var smp = $('#smp').val();
            var rombel = $('#rombel').val();
            var tingkat = $('#tingkat').val();
            if (nisn.length != 10) {
                alert('NISN HARUS 10 DIGIT');
            }
            $.ajax({
                type: 'post',
                url: '/op/siswa/add',
                data: {
                    nama: nama,
                    nisn: nisn,
                    rombel: rombel,
                    tingkat: tingkat,
                },
                success: function(data) {
                    $('#exampleModaladd').modal('hide');
                    $('#myTable').DataTable().ajax.reload();
                    clear();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Tambah Siswa Berhasil'
                    })
                }
            })

        }

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

        function destroy(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'delete',
                        url: "/op/siswa/delete/" + id,
                        success: function() {
                            $('#myTable').DataTable().ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Hapus Siswa Berhasil'
                            })
                        }
                    });

                }
            })
        }

        function clear() {
            var nama = $('#nama').val('');
            var nisn = $('#nisn').val('');
            var rombel = $('#rombel').val('');
            var tingkat = $('#tingkat').val('');
        }

        function showModal() {
            $('#exampleModaladd').modal('show');
        }

        function store() {
            var id = $('#id').val();
            var nisn = $('#nisna').val();
            var rombel = $('#rombela').val();
            $.ajax({
                type: 'post',
                url: "{{ url('/op/siswa/storenisn') }}",
                data: {
                    id: id,
                    nisn: nisn,
                    rombel: rombel
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
