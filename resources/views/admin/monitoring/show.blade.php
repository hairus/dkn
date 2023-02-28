<table class="table" id="siswasTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nisn</th>
            <th>Tingkat</th>
            <th>Npsn</th>
            <th>Sekolah SMA</th>
            <th>Sekolah SMP</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#siswasTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url :"{{ route('dp.getData') }}",
                type:"get",
            },
            lengthMenu: [10, 20, 50, 100, 200, 500, 1000],
            columns: [
                {
                    data: 'DT_RowIndex',
                    name:'id'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'nisn'
                },
                {
                    'data' : 'tingkat'
                },
                {
                    data: 'npsn_sekolah'
                },
                {
                    data: 'nama_sekolah'
                },
                {
                    data: 'asal_sekolah'
                }
            ]
        });
    });
</script>
