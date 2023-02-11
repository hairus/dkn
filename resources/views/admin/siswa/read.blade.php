<table class="table" id="siswasTable">
    <thead>
        <tr>
            <th>NO</th>
            <th>NPSN</th>
            <th>SISWA</th>
            <th>NAMA SEKOLAH</th>
            <th>TINGKAT</th>
            <th>Nilai</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswas as $key => $siswa)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $siswa->npsn }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->sekolahs->nm_sekolah }}</td>
                <td>{{ $siswa->tingkat_kelas }}</td>
                <td>{{ $siswa->nilai->rerata }}</td>
                <td>
                    <span class="badge rounded-pill bg-primary">
                        <span class="mdi mdi-pencil"></span>
                    </span>
                    <span class="badge rounded-pill bg-danger">
                        <span class="mdi mdi-delete"></span>
                    </span>
                    <span class="badge rounded-pill bg-warning">
                        <span class="mdi mdi-domain"></span>
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#siswasTable').DataTable();
    });
</script>
