<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pengambilan Surat</title>
    
    <style>
        body {
            margin: 0px;
        }
        @page {
            size: 300pt auto;
            margin: 5mm; 
        }
        
        .container-item {
            font-size:18px;
        }
        .container-item td {
            padding-top: 8px;
            padding-left: 15px; 
        }
        .item {
            font-weight: 600;
            width: 160px;
            vertical-align: top;
        }
        .item-sep {
            width: 3px;
            vertical-align: top;
        }
        .item-value {
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <section >
        <table>
            <tr>
                <th style="width: 130px; text-align:center;"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(120)->generate('kode#'.$data->nomor)) !!} "></th>
                <th style="font-size:24px;">Bukti Pengambilan Legalisir Dokumen</th>
            </tr>
            <tr>
                <td style="font-size:8pt; text-align:center; vertical-align: text-top;">{{ $data->nomor }}</td>
            </tr>
        </table>
    </section> 
    <section style="margin-top:40px;">
        <table class="container-item">
            <tr>
                <td class="item">Nama</td>
                <td class="item-sep">:</td>
                <td class="item-value">{{ $data->mahasiswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="item">NIM</td>
                <td class="item-sep">:</td>
                <td class="item-value">{{ $data->mahasiswa->npm ?? '-' }}</td>
            </tr>
            <tr>
                <td class="item">Program Studi</td>
                <td class="item-sep">:</td>
                <td class="item-value">{{ $data->mahasiswa->prodi->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="item">Status Mahasiswa</td>
                <td class="item-sep">:</td>
                <td class="item-value">{{ $data->mahasiswa->status ?? '-' }}</td>
            </tr>
            <tr>
                <td class="item">Tanggal Pengajuan</td>
                <td class="item-sep">:</td>
                <td class="item-value">{{ $data->created_at ?? '-' }}</td>
            </tr>
            <tr>
                <td class="item">Jenis Dokumen</td>
                <td class="item-sep">:</td>
                <td class="item-value">{{ $data->jenis ?? '-' }}</td>
            </tr>
            <tr>
                <td class="item">Keterangan</td>
                <td class="item-sep">:</td>
                <td class="item-value">{{ $data->keterangan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="item">Status</td>
                <td class="item-sep">:</td>
                <td class="item-value">{{ $data->status ?? '-' }}</td>
            </tr>
        </table>
    </section>
</body>
</html>