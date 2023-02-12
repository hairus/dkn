@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        SMP/MTS
                    </div>
                    <table class="table table-hover" id="users">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>NPSN</td>
                                <td>Password</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->npsn }}</td>
                                <td>{{ $data->password_real }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#users').DataTable();
        });
    </script>
@endsection

