<table class="table table-borderer table-hover" id="smps">
    <thead>
        <tr>
            <th>No</th>
            <th>Sekolah</th>
            <th>Npsn</th>
            <th>Jenjang</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#smps').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url :"{{ route('getDataSmp') }}",
                type:"get",
            },
            lengthMenu: [10, 20, 50, 100, 200, 500, 1000],
            columns: [
                {
                    data: 'DT_RowIndex',
                    name:'id'
                },
                {
                    data: 'nama_smp',
                },
                {
                    data: 'npsn_smp',
                },
                {
                    data: 'jenjang',
                },
                {
                    data: 'jenjang',
                },
            ]
        });
    });
    })
</script>
