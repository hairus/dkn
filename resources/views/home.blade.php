@extends('layouts.app')

@section('content')
    <div class="card">
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
    </div>
@endsection