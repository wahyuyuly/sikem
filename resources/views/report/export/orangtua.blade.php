<table>
    <thead>
        <tr>
            <th>Report Data Mahasiswa</th>
        </tr>
        <tr>
            <th>Run date {{ \Carbon\Carbon::now()->format('Y-m-d h:m:s A') }}</th>
        </tr>
        <tr></tr>
        <tr>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Nama Orang Tua</th>
            <th>Hubungan</th>
            <th>NIK</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Agama</th>
            <th>Pendidikan</th>
            <th>Pekerjaan</th>
            <th>No Telp</th>
            <th>Penghasilan</th>
            <th>Alamat</th>
            <th>Kelurahan/Desa</th>
            <th>Kecamatan</th>
            <th>Kota/Kabupaten</th>
            <th>Provinsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $value)
            @foreach($value->orangtua as $item)
                <tr>
                    <td>{{ $value->npm ?? '' }}</td>
                    <td>{{ $value->nama ?? '' }}</td>
                    <td>{{ $item->nama ?? '' }}</td>
                    <td>{{ $item->jenis ?? '' }}</td>
                    <td>{{ $item->nik ?? '' }}</td>
                    <td>{{ $item->tempat_lahir ?? '' }}</td>
                    <td>{{ $item->tanggal_lahir ?? '' }}</td>
                    <td>{{ $item->agama ?? '' }}</td>
                    <td>{{ $item->pendidikan->name?? '' }}</td>
                    <td>{{ $item->pekerjaan ?? '' }}</td>
                    <td>{{ $item->telp ?? '' }}</td>
                    <td>{{ $item->penghasilan?? '' }}</td>
                    <td>{{ $item->alamat ?? '' }}</td>
                    <td>{{ $item->kelurahan->name ?? '' }}</td>
                    <td>{{ $item->kelurahan->kecamatan->name ?? '' }}</td>
                    <td>{{ $item->kelurahan->kecamatan->kota->name ?? '' }}</td>
                    <td>{{ $item->kelurahan->kecamatan->kota->provinsi->name ?? '' }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>