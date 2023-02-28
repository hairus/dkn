@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Unlock
                    </div>
                    <div class="table-responsive">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>nama</th>
                                <th>NPSN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
                    url: "{{ url('/admin/showSma') }}",
                    type: "get",
                },
                lengthMenu: [10, 20, 50, 100, 200, 500, 1000],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'nm_sekolah',
                        name: 'nm_sekolah'
                    },
                    {
                        data: 'npsn',
                        name: 'npsn'
                    },
                    {
                        data: 'action',
                    },

                ]
            });
        });

        function unlockds(id) {
            $.ajax({
                type: 'get',
                url: '/admin/unlockds/' + id,
                success: function(data) {
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
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'Unlock Data Siswa Berhasil'
                    });

                    setTimeout(function(){
                        location.reload();
                    },3000);
                }
            })
        }

        function unlockns(id) {
            $.ajax({
                type: 'get',
                url: '/admin/unlockns/' + id,
                success: function(data) {
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
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'Unlock Nilai Siswa Berhasil'
                    });

                    setTimeout(function(){
                        location.reload();
                    },3000);
                }
            })
        }
    </script>
@endsection
