@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        SEKOLAH SMA / SMK
                    </div>
                    <button type="button" class="btn btn-sm btn-primary float-end mb-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <span class="fa fa-plus"></span>
                    </button>
                    <div id="read"></div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD SEKOLAH</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="page"></div>
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
            read();
            create();
        });

        function read() {
            $.get("{{ url('/admin/allSekolah/read') }}", {}, function(data, status) {
                $('#read').html(data)
            })
        }

        function create() {
            $.get("{{ url('/admin/allSekolah/create') }}", {}, function(data, status) {
                $('#page').html(data);
            });
        }

        function simpan() {
            var kab_kota = $('#kab_kota').val();
            var nama = $('#nama').val();
            var npsn = $('#npsn').val();
            var jenjang = $('#jenjang').val();
            $.ajax({
                type: 'post',
                url: "{{ url('/admin/allSekolah/store') }}",
                data: {
                    nama: nama,
                    kab_kota: kab_kota,
                    npsn: npsn,
                    jenjang: jenjang
                },
                success: function(data) {
                    read()
                    batal()
                }
            });
        }

        function destroy(id) {
            let text = "Press a button!\nEither OK or Cancel.";
            if (confirm(text) == true) {
                $.ajax({
                    type: "delete",
                    url: "/admin/allSekolah/destroy/" + id,
                    success: function(data) {
                        read()
                    }
                })
            }
        }

        function edit(id) {
            $.ajax({
                type: 'get',
                url: "/admin/allSekolah/edit/" + id,
                success: function(data) {
                    $('#exampleModal').modal('show');
                    $('#exampleModalLabel').html('EDIT SEKOLAH')
                    $('#page').html(data)
                }
            });
        }

        function update() {
            var kab_kota = $('#kab_kota').val();
            var sma_id = $('#sma_id').val();
            var nama = $('#nama').val();
            var npsn = $('#npsn').val();
            var jenjang = $('#jenjang').val();
            $.ajax({
                type: 'patch',
                url: "{{ url('/admin/allSekolah/update') }}",
                data: {
                    nama: nama,
                    kab_kota: kab_kota,
                    npsn: npsn,
                    jenjang: jenjang,
                    sma_id: sma_id
                },
                success: function(data) {
                    $('#exampleModalLabel').html('ADD SEKOLAH')
                    $('#page').html('')
                    create();
                    read()
                    batal()
                }
            });
        }

        function batal() {
            $('#exampleModal').modal('hide');
            create();
            $('#exampleModalLabel').html('ADD SEKOLAH')
            $('#page').html('')
        }
    </script>
@endsection
