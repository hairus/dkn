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
                    <hr class="mb-4">
                    <form action="{{ url('/op/updatePassword') }}" method="post" id="form">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" onclick="test()">
                                    <i class="mdi mdi-account-check"></i>
                                </span>
                            </div>
                            <input type="password" id="password" class="form-control" placeholder="password minimal 8"
                                aria-label="Username" name="password" aria-describedby="basic-addon1" maxlength="10"
                                minlength="8">
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function test() {
            var password = $('#password').val();
            alert(password);
        }
    </script>
@endsection
