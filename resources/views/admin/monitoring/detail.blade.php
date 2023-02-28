@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Monitoring detail
                    </div>
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>ID</th>
                            <th>NPSN</th>
                            <th>NAMA SEKOLAH</th>
                            <th>Jumlah Data Siswa</th>
                            <th>Jumlah Data Nilai</th>
                            <th>Progres</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach ($smas as $key => $kab)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>
                                        {{$kab->npsn}}
                                    </td>
                                    <td>
                                        {{ $kab->nm_sekolah }}
                                    </td>
                                    <td>
                                        {{ $gg[$kab->npsn] }}
                                    </td>
                                    <td>
                                        {{ $gg1[$kab->npsn] }}
                                    </td>
                                    <td>
                                        @php
                                            $jum = ($gg1[$kab->npsn] / $gg[$kab->npsn]) * 100;
                                        @endphp
                                        {{ round($jum, 2) }}%
                                    </td>
                                    <td>
                                        @if($kab->user->fns->final == false)
                                        Belum Final
                                        @else
                                        <span class="badge bg-success">OK</span>
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
            read()
        });
    </script>
@endsection
