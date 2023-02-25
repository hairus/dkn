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
                    @if (Auth::user()->fns->final == false)
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
                        <a href="/op/siswa/delSis" id="hap">
                            <button type="button" onclick="hapusSiswa()"
                                class="btn btn-sm btn-danger text-white float-end mb-3 ms-2">
                                <span class="fa fa-file"></span> Hapus Semua Nilai
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
                                <th>NILAI</th>
                                <th>NPSN SMP</th>
                                <th>SMP ASAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($smas as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->nisn }}</td>
                                    <td>{{ $data->tingkat }}</td>
                                    <td>{{ $data->rombel }}</td>
                                    <td>{{ $data->rerata }}</td>
                                    <td>{{ $data->npsn_smp }}</td>
                                    <td>
                                        @if ($data->nama_smp)
                                            {{ $data->nama_smp }}
                                        @else
                                            <span class="badge bg-pill bg-danger">TIDAK ADA DALAM DATABASE</span>
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
            $('#myTable').DataTable({
                // order: [
                //     [3, 'ASC'],
                //     [4, 'ASC'],
                //     [1, 'ASC']
                // ],
            });
        });

        function hapusSiswa() {
            $('#hap').on('click', function(e) {
                e.preventDefault();
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
                            type: 'get',
                            url: "/op/siswa/delSis",
                            success: function() {
                                Swal.fire(
                                    'Deleted!',
                                    'Your students has been deleted.',
                                    'success'
                                )
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            }
                        })
                    }
                })
            })
        }
    </script>
@endsection
