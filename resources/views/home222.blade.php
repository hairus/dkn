@extends('layouts.app')

@section('content')
    <div class="card">
        @if (auth()->user()->roles->role == 1)    
        <div class="card-body col-md-12">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ url('/admin/allSekolah') }}">
                            <div class="bg-dark p-10 text-white text-center">
                                <i class="fa fa-tag mb-1 font-16"></i>
                                <h5 class="mb-0 mt-1">{{ $sekolahs->count() }}</h5>
                                <small class="font-light">Sekolah SMA / SMK</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-1 mt-1">{{ $siswas->count() }}</h5>
                            <small class="font-light">Total Siswa</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-globe mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">{{ $kabs->count() }}</h5>
                            <small class="font-light">Kabupaten - Kota</small>
                        </div>
                    </div>
                </div>
        </div>
        @else
        <!-- <div class="card-body col-md-12">
                <div class="row">
                    <div class="card-title">
                        <H3>{{ $sekolah->nm_sekolah }}</H3>
                    </div>
                </div>
                <hr>
                <h4>Data Siswa<h4>
                <div class="row">
                    <div class="col">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-1 mt-1">{{ $siswa1s_10->count() }}</h5>
                            <small class="font-light">Kelas 10</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-1 mt-1">{{ $siswa1s_11->count() }}</h5>
                            <small class="font-light">Kelas 11</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-1 mt-1">{{ $siswa1s_12->count() }}</h5>
                            <small class="font-light">Kelas 12</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-1 mt-1">{{ $siswa1s->count() }}</h5>
                            <small class="font-light">Total Siswa</small>
                        </div>
                    </div>
                </div>
        </div> -->
        <div class="card-body col-md-12">
            <div class="row">
                <div class="card-title">
                    <H3>{{ $sekolah->nm_sekolah }}</H3>
                </div>
            </div>
            <hr>    
            <h2>Status Finalisasi</h2>
            <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                    <th>Jenis Finalisasi</th>
                    <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Finalisasi Data Siswa</td>
                    <td>
                            @if ($fds)
                                @if ($fds->final == false)
                                    <span style="color:red;font-weight: bold;">BELUM</span>
                                @else
                                    <span style="color:green;font-weight: bold;">SUDAH</span>
                                @endif
                            @else
                                <span style="color:red;font-weight: bold;">BELUM</span>
                            @endif
                    </td>
                    </tr>
                    
                    <tr>
                    <td>Finalisasi Data Nilai</td>
                    <td>
                            @if ($fns)
                                @if ($fns->final == false)
                                    <span style="color:red;font-weight: bold;">BELUM</span>
                                @else
                                    <span style="color:green;font-weight: bold;">SUDAH</span>
                                @endif
                            @else
                                <span style="color:red;font-weight: bold;">BELUM</span>
                            @endif
                    </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="card-body col-md-12">
                <h2>Rekap Pengisian Anisa Jatim</h2>
                <div class="table-responsive">
                <table id="rekap" class="display table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                <th width=20%><center>Jenis Data</center></th>
                <th width=20%><center>Kelas 10</center></th>
                <th width=20%><center>Kelas 11</center></th>
                <th width=20%><center>Kelas 12</center></th>
                <th width=20%><center>Total</center></th>
                </tr>
                <tr>
                <td>Data Siswa</td>
                <td>{{ $siswa1s_10->count() }}</td>
                <td>{{ $siswa1s_11->count() }}</td>
                <td>{{ $siswa1s_12->count() }}</td>
                <td>{{ $siswa1s->count() }}</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>Data Nilai</td>
                <td>{{ $siswa2s_10->count() }}</td>
                <td>{{ $siswa2s_11->count() }}</td>
                <td>{{ $siswa2s_12->count() }}</td>
                <td>{{ $siswa2s->count() }}</td>
                </tr>
                </tbody>
                </table>
                </div>
        </div>
        <!-- <div class="card-body col-md-12">
                <h4>Data Nilai<h4>
                <div class="row">
                    <div class="col">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-1 mt-1">{{ $siswa2s_10->count() }}</h5>
                            <small class="font-light">Kelas 10</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-1 mt-1">{{ $siswa2s_11->count() }}</h5>
                            <small class="font-light">Kelas 11</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-1 mt-1">{{ $siswa2s_12->count() }}</h5>
                            <small class="font-light">Kelas 12</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-1 mt-1">{{ $siswa2s->count() }}</h5>
                            <small class="font-light">Total Siswa</small>
                        </div>
                    </div>
                </div>
        </div> -->
        @endif
    </div>
@endsection
