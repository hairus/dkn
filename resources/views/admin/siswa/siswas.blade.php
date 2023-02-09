@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        SISWA
                    </div>
                    <button onclick="create()" type="button" class="btn btn-sm btn-primary float-end mb-3 ms-2"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="/admin/siswa/import">
                        <button type="button" class="btn btn-sm btn-primary float-end mb-3" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <span class="fa fa-file"></span>
                        </button>
                    </a>
                    <div id="read"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD SISWA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="page"></div>
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
            $.get("{{ url('/admin/siswas/show') }}", {}, function(data, status) {
                $('#read').html(data)
            })
        }

        function create() {
            $.get("{{ url('/admin/siswas/create') }}", {}, function(data, status) {
                $('#page').html(data)
            });
        }

        function simpan() {
            // var dta = new FormData(this);
            var formData = new FormData();
            formData.append('file', $('#file').get(0).files[0]);
            formData.append('fileName', $("#documents").val());

            $.ajax({
                type: 'POST',
                url: "{{ url('/admin/siswas/') }}",
                processData: false,
                contentType: false,
                data: formData,
                success: function(data) {
                    console.log("File Uploaded");
                }

            });
        }
    </script>
@endsection
