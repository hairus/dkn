<div class="table-responsive">
<table class="table table-hover" id="myTable">
    <thead>
        <tr>
            <th>NO</th>
            <th>SEKOLAH</th>
            <th>SISWA</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url :"{{ url('/admin/getDataSekolah') }}",
                type:"get",
            },
            lengthMenu: [10, 20, 50, 100, 200, 500, 1000],
            columns: [
                {
                    data: 'DT_RowIndex',
                    name:'id'
                },
                {
                    data: 'nm_sekolah',
                    name:'nm_sekolah'
                },
                {
                    data: 'siswas',
                    name:'siswas'
                },
            ]
        });
    });
</script>
