@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">                
                <div class="card-body">
                    <div class="card-title">
                        {{ $sma->nm_sekolah }}
                    </div>
                    <hr class="mb-4">                   
                    @if ($message = Session::get('message'))
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                    @elseif ($message = Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                {{ $message }}
                            </div>
                    @elseif ($no_nilai == 0)
                            <div class="alert alert-danger" role="alert">
                                Silahkan lengkapi, Data Nilai masih kosong!
                            </div>
                    @endif
                    @if (Auth::user()->fns->final == false)
                    <div class="col-sm-12">
                        <a href="/op/siswa/import">
                            <button type="button" class="btn btn-sm btn-success text-white mb-3 ms-2">
                                <span class="fa fa-file"></span> Upload Nilai
                            </button>
                        </a>
                        <a href="{{ url('/op/export') }}">
                            <button type="button" class="btn btn-sm btn-primary mb-3 ms-2">
                                <span class="fa fa-file"></span> Download Tempate
                            </button>
                        </a>
                        <a href="{{ url('/op/export/smp') }}">
                            <button type="button" class="btn btn-sm btn-default mb-3 ms-2">
                                <span class="fa fa-file"> </span> Download NPSN SMP
                            </button>
                        </a>
                        <a href="/op/siswa/delSis" id="hap">
                            <button type="button" onclick="hapusSiswa()"
                                class="btn btn-sm btn-danger text-white mb-3 ms-2">
                                <span class="fa fa-file"></span> Hapus Semua Nilai
                            </button>
                        </a>
                    </div>
                    @endif
                    <div class="table-responsive">
                    <table id="myTable">
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
                    <div class="alert alert-warning" role="alert">
                        Catatan: 
                        <ol>
                            <li>Nilai yang dimasukkan ke dalam sistem adalah nilai <b>Peserta Didik Aktif</b> yang pernah memiliki riwayat nilai di SMA/SMK Negeri di Jawa Timur</li>
                            <li>Apabila peserta didik berasal dari SMP/MTs Luar Jatim atau berasal dari PKBM, maka pada kolom keterangan pada tabel di atas akan dimunculkan kalimat <b>TIDAK ADA DALAM DATABASE</b> dan <b>NILAI TETAP MASUK DALAM SISTEM</b>.</li>
                        </ol>
                    </div>
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
                    title: 'Yakin Menghapus Data Ini?',
                    text: "Kamu Tidak Akan Dapat Melihat Data Ini Lagi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'get',
                            url: "/op/siswa/delSis",
                            success: function() {
                                Swal.fire(
                                    'Dihapus!',
                                    'Seluruh Data Nilai Berhasil Dihapus!.',
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
