@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Batas Akhir Pengisian
                    </div>
                    <a href="{{ url('/admin/addDead') }}">
                        <button class="btn btn-primary mb-3">Add</button>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>NO</th>
                                <th>Kab/Kota</th>
                                <th>Deadline</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($deadlines as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->kabs->kab_kota }}</td>
                                        <td>{{ $data->deadline }}</td>
                                        <td>
                                            <a href="{{ url('/admin/delDead/'.$data->id) }}">
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </a>
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
