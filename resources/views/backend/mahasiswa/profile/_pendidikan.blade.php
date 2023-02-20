<div class="table-responsive">
    <table class="dataList table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenjang</th>
                <th>Nama Sekolah</th>
                <th>Tahun Masuk</th>
                <th>Tahun Lulus</th>
                <th>Nilai</th>
                <th>Ijazah</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($data->riwayat_sekolah->sortBy('tahun_masuk') as $i => $item)                
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->tingkat ?? '-' }}</td>
                <td>{{ $item->nama ?? '-' }}</td>
                <td>{{ $item->tahun_masuk  ?? '-'}}</td>
                <td>{{ $item->tahun_lulus  ?? '-'}}</td>
                <td>{{ $item->nilai  ?? '-'}}</td>
                <td>
                    @if ($item->ijazah != null)
                        @php
                            $link = base64_encode($item->mahasiswa_id.'/ijazah/'.$item->ijazah);
                        @endphp
                        <a href="{{ route('download.attachment', $link) }}" class="btn btn-sm btn-primary btn-icon icon-left"><i class="fas fa-file-download"></i> Unduh</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>