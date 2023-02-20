<div class="table-responsive">
    <table class="dataList table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tahun</th>
                <th>Sakit</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($data->penyakit->sortBy('tahun') as $i => $item)                
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->tahun ?? '-' }}</td>
                <td>{{ $item->nama ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>