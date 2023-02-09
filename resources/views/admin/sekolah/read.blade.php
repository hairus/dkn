<table class="table table-hover" id="myTable">
    <thead>
        <tr>
            <th>NO</th>
            <th>KODE UN</th>
            <th>NPSN</th>
            <th>NAMA SEKOLAH</th>
            <th>SISWA</th>
            <th>KAB/KOTA</th>
            <th>JENJANG</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sekolahs as $key => $sekolah)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $sekolah->kode_un }}</td>
                <td>{{ $sekolah->npsn }}</td>
                <td>{{ $sekolah->nm_sekolah }}</td>
                <td>
                    @if ($sekolah->siswas->count() > 1)
                        <span class="badge rounded-pill bg-info">{{ $sekolah->siswas->count() }}</span>
                    @else
                        <span class="badge rounded-pill bg-success">{{ $sekolah->siswas->count() }}</span>
                    @endif
                </td>
                <td>{{ $sekolah->kab_kotas->kab_kota }}</td>
                <td>{{ $sekolah->jenjang }}</td>
                <td>
                    <span class="badge rounded-pill bg-primary" onclick="edit({{ $sekolah->id }})">
                        <span class="mdi mdi-pencil"></span>
                    </span>
                    <span class="badge rounded-pill bg-danger" onclick="destroy({{$sekolah->id}})">
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
        $('#myTable').DataTable();
    });
</script>
