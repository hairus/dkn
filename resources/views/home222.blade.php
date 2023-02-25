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
        <div class="card-body col-md-12">
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
        </div>
        <div class="card-body col-md-12">
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
        </div>
        @endif
    </div>
@endsection
