@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Monitoring
                    </div>
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Kab/Kota</th>
                            <th>Jumlah Sekolah</th>
                            <th>Jumlah Data Siswa</th>
                            <th>Jumlah Data Nilai</th>
                            <th>Progres</th>
                        </thead>
                        <tbody>
                            @foreach ($kabs as $kab)
                                <tr>
                                    <td>{{ $kab->id }}</td>
                                    <td>
                                        <a href="{{ url('/admin/monitoring/detail/'.$kab->id) }}">
                                            <button class="btn btn-primary btn-sm">{{ $kab->kab_kota }}</button>
                                        </a>
                                    </td>
                                    <td>
                                        {{ $kab->sekolahs->count() }}
                                    </td>
                                    <td>
                                        {{ $gg[$kab->id] }}
                                    </td>
                                    <td>
                                        {{ $gg1[$kab->id] }}
                                    </td>
                                    <td>
                                        @php
                                            $jum = ($gg1[$kab->id] / $gg[$kab->id]) * 100;
                                        @endphp
                                        {{ round($jum, 2) }}%
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
