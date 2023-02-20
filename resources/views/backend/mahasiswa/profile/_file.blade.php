<div class="table-responsive">
    <a href="{{ route('mahasiswa.file', $data->id) }}" class="mb-3 btn btn-sm btn-outline-success btn-cion icon-left"><i class="fas fa-file-upload"></i> Tambah File</a>
    <table id="dataList" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Berkas</th>
                <th>Keterangan</th>
                <th>Aksi</th>
                <th>Pilihan</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($data->files as $i => $item)                
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="{{ route('download.mahasiswa', $item->id) }}" class="btn btn-sm btn-primary btn-icon icon-left"><i class="fas fa-file-download"></i> Unduh</a>
                </td>
                <td>
                    {!! Form::open(['url'=>route('mahasiswa.filedestroy', $item->id), 'method'=>'delete']) !!}
                    <button type="submit" class="btn btn-sm btn-danger btn-icon icon-left delete"><i class="fas fa-trash"></i> Hapus</button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>