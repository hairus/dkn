@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Data Pokok
                    </div>
                    <div id="read">

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

        function read() {
            $.get("{{ url('/admin/dp/show') }}", {}, function(data, status) {
                $('#read').html(data)
            })
        }
    </script>
@endsection
