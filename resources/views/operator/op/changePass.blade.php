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
                    <form action="{{ url('/op/updatePassword') }}" method="post" id="form">
                        @csrf
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-8">
                                <input type="password" id="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Ulangi Password</label>
                            <div class="col-md-8">
                                <input type="password" id="password" class="form-control" name="confirm_password" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
