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
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        {{ $sma->nm_sekolah }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Finalisasi Data Siswa
                            </div>
                            <p>Saya adalah kepala sekolah, dengan ini menyatakan bahwa data yang saya masukkan adalah data
                                yang benar. Apabila dikemudian hari terdapat kesalahan data maka sepenuhnya menjadi tanggung
                                jawab saya. 
                            </p>
                            <p>Setelah finalisasi, Anda tidak dapat mengubah Data Siswa.</p>
                            @if ($fds)
                                @if ($fds->final == false)
                                    <button class="btn btn-sm btn-primary" onclick="fds()">Finalisasi Data Siswa</button>
                                @else
                                    <button class="btn btn-sm btn-primary mb-2" onclick="fds()" disabled>
                                        Anda telah melakukan finalisasi pada {{ $fds->updated_at }}
                                    </button>
                                @endif
                            @else
                                <button class="btn btn-sm btn-primary" onclick="fds()">Finalisasi Data Siswa</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Finalisasi Nilai
                            </div>
                            <p>Saya adalah kepala sekolah, dengan ini menyatakan bahwa data yang saya masukkan adalah data
                                yang benar. Apabila dikemudian hari terdapat kesalahan data maka sepenuhnya menjadi tanggung
                                jawab saya.
                            </p>
                            <p>Setelah finalisasi, Anda tidak dapat mengubah Data Nilai.</p>
                            @if ($fds->final == false)
                                <button class="btn btn-sm btn-primary mb-2" onclick="fns()" disabled>Finalisasi Data
                                    Nilai</button>
                            @else
                                @if ($fns)
                                    @if ($fns->final == false)
                                        <button class="btn btn-sm btn-primary" onclick="fns()">Finalisasi Data Nilai</button>
                                    @else
                                        <button class="btn btn-sm btn-primary mb-2" onclick="fns()" disabled>Anda telah melakukan finalisasi pada {{ $fns->updated_at }}</button>
                                    @endif
                                @else
                                    <button class="btn btn-sm btn-primary" onclick="fns()">Finalisasi Data Nilai</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function fds() {
            Swal.fire({
                title: 'Apakah anda yakin finalisasi data siswa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Setuju',
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'get',
                        url: "/op/fds",
                        success: function() {
                            Swal.fire(
                                'Sukses!',
                                'Finalisasi Data Siswa Berhasil.',
                                'success'
                            )
                            setTimeout(() => {
                                //location.reload();
                                window.location = "/op/siswaNilai";
                            }, 2000);
                        }
                    })
                }
            })
        }

        function fns() {
            Swal.fire({
                title: 'Apakah anda yakin finalisasi data nilai?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Setuju',
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'get',
                        url: "/op/fns",
                        success: function() {
                            Swal.fire(
                                'Sukses!',
                                'Finalisasi Data Nilai Berhasil.',
                                'success'
                            )
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        }
                    })
                }
            })
        }
    </script>
@endsection
