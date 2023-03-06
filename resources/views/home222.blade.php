@extends('layouts.app')

@section('css')
@if (auth()->user()->roles->role == 1)
@else
<style>
#timer {
    font-size: 3em;
    font-weight: 100;
    color: white;
    padding: 20px;
    width: 700px;
    color: white;
    
}

#timer div {
    display: inline-block;
    min-width: 90px;
    padding: 15px;
    background: #020b43;
    border-radius: 10px;
    border: 2px solid #030d52;
    margin: 15px;
}

#timer div span {
    color: #ffffff;
    display: block;
    margin-top: 15px;
    font-size: .35em;
    font-weight: 400;
}
</style>
@endif
@endsection

@section('content')
    <div class="card">
        @if (auth()->user()->roles->role == 1)
            <div class="card-body col-md-12">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ url('/admin/allSekolah') }}">
                            <div class="bg-dark p-10 text-white text-center">
                                <i class="fa fa-tag mb-1 font-10"></i>
                                <h5 class="mb-0 mt-1">{{ $sekolahs->count() }}</h5>
                                <small class="font-light">Sekolah SMA / SMK</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-10"></i>
                            <h5 class="mb-1 mt-1">{{ $siswas }}</h5>
                            <small class="font-light">Total Siswa Fix</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-globe mb-1 font-10"></i>
                            <h5 class="mb-0 mt-1">{{ $kabs->count() }}</h5>
                            <small class="font-light">Kabupaten - Kota</small>
                        </div>
                    </div>
                    <div class="col-6 mt-1">
                        <div class="bg-dark p-10 text-white text-center">
                            <i class="fa fa-user mb-1 font-16"></i>
                            <h5 class="mb-0 mt-1">{{ $dp }}</h5>
                            <small class="font-light">Total Data Pokok</small>
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
                                <th width=20%>
                                    <center>Jenis Data</center>
                                </th>
                                <th width=20%>
                                    <center>Kelas 10</center>
                                </th>
                                <th width=20%>
                                    <center>Kelas 11</center>
                                </th>
                                <th width=20%>
                                    <center>Kelas 12</center>
                                </th>
                                <th width=20%>
                                    <center>Total</center>
                                </th>
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
            <div class="card-body col-md-12">
                    <div style="text-align: center;display: flex;justify-content: center;">
                        <div id="timer"></div>
                    </div>
                    <div class="card-title"><center>Deadline: {{ $dln->deadline }}</center></div>  
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

@section('script')
@if (auth()->user()->roles->role == 1)
@else
<script type="text/javascript">
function updateTimer() {
    future = Date.parse("{{ $dln->deadline }}");
    now = new Date();
    diff = future - now;

    days = Math.floor(diff / (1000 * 60 * 60 * 24));
    hours = Math.floor(diff / (1000 * 60 * 60));
    mins = Math.floor(diff / (1000 * 60));
    secs = Math.floor(diff / 1000);

    d = days;
    h = hours - days * 24;
    m = mins - hours * 60;
    s = secs - mins * 60;

    if(d < 10){d = "0" + d;}
    if(h < 10){h = "0" + h;}
    if(m < 10){m = "0" + m;}
    if(s < 10){s = "0" + s;}

    // If the count down is over, write some text 
    if (diff >= 0) {
        d = days;
        h = hours - days * 24;
        m = mins - hours * 60;
        s = secs - mins * 60;
    } else {
        clearInterval();
        d = h = m = s = 0;
    }
    
    document.getElementById("timer")
            .innerHTML =
            '<div>' + d + '<span>Hari</span></div>' +
            '<div>' + h + '<span>Jam</span></div>' +
            '<div>' + m + '<span>Menit</span></div>' +
            '<div>' + s + '<span>Detik</span></div>';
}
setInterval('updateTimer()', 1000);
</script>
@endif
@endsection
