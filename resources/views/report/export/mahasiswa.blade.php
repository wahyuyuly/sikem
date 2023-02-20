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
            <th>Nama</th>
            <th>Nama Panggilan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Suku Bangsa</th>
            <th>Golongan Darah</th>
            <th>Rhesus</th>
            <th>Tinggi Badan (cm)</th>
            <th>Berat Badan (kg)</th>
            <th>Anak Ke</th>
            <th>Jumlah Saudara</th>
            <th>Jenjang Pendidikan</th>
            <th>Jurusan</th>
            <th>Program Studi</th>
            <th>Tahun Masuk</th>
            <th>Jalur Penerimaan</th>
            <th>Status</th>
            <th>Tanggal Yudisium</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Kelurahan/Desa</th>
            <th>Kecamatan</th>
            <th>Kota/Kabupaten</th>
            <th>Provinsi</th>
            <th>Alamat Domisili</th>
            <th>Kelurahan/Desa Domisili</th>
            <th>Kecamatan Domisili</th>
            <th>Kota/Kabupaten Domisili</th>
            <th>Provinsi Domisili</th>
            <th>Status Tempat Domisili</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->npm ?? '' }}</td>
                <td>{{ $item->nama ?? '' }}</td>
                <td>{{ $item->nama_panggilan ?? '' }}</td>
                <td>{{ $item->tempat_lahir ?? '' }}</td>
                <td>{{ $item->tanggal_lahir ?? '' }}</td>
                <td>{{ $item->jenis_kelamin ?? '' }}</td>
                <td>{{ $item->agama ?? '' }}</td>
                <td>{{ $item->suku_bangsa ?? '' }}</td>
                <td>{{ $item->golongan_darah ?? '' }}</td>
                <td>{{ $item->rhesus ?? '' }}</td>
                <td>{{ $item->tinggi_badan ?? '' }}</td>
                <td>{{ $item->berat_badan ?? '' }}</td>
                <td>{{ $item->anak_ke ?? '' }}</td>
                <td>{{ $item->jumlah_saudara ?? '' }}</td>
                <td>{{ $item->prodi->tingkat->name ?? '' }}</td>
                <td>{{ $item->prodi->jurusan->name ?? '' }}</td>
                <td>{{ $item->prodi->name ?? '' }}</td>
                <td>{{ $item->tahun_masuk ?? '' }}</td>
                <td>{{ $item->jalur_penerimaan ?? '' }}</td>
                <td>{{ $item->status ?? '' }}</td>
                <td>{{ $item->tanggal_yudisium ?? '' }}</td>
                <td>{{ $item->account->email ?? ''}}</td>
                <td>{{ $item->telp ?? '' }}</td>
                <td>{{ $item->alamat ?? '' }}</td>
                <td>{{ $item->kelurahan->name ?? '' }}</td>
                <td>{{ $item->kelurahan->kecamatan->name ?? '' }}</td>
                <td>{{ $item->kelurahan->kecamatan->kota->name ?? '' }}</td>
                <td>{{ $item->kelurahan->kecamatan->kota->provinsi->name ?? '' }}</td>
                <td>{{ $item->alamat_tinggal ?? '' }}</td>
                <td>{{ $item->kelurahan_domisili->name ?? '' }}</td>
                <td>{{ $item->kelurahan_domisili->kecamatan->name ?? '' }}</td>
                <td>{{ $item->kelurahan_domisili->kecamatan->kota->name ?? '' }}</td>
                <td>{{ $item->kelurahan_domisili->kecamatan->kota->provinsi->name ?? '' }}</td>
                <td>{{ $item->status_tinggal ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>