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
        @foreach ($smps as $key => $smp)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $smp->nama_smp }}</td>
            <td>{{ $smp->npsn_smp }}</td>
            <td>{{ $smp->jenjang }}</td>
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
        $('#smps').DataTable();
    })
</script>
