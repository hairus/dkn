<table class="table" id="siswasTable">
    <thead>
        <tr>
            <th>id</th>
            <th>Nama</th>
            <th>Nisn</th>
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
            ajax: "/dp/getData",
            lengthMenu: [10, 20, 50, 100, 200, 500],
            columns: [{
                    data: 'id',
                },
                {
                    data: 'nama'
                },
                {
                    data: 'nisn'
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
