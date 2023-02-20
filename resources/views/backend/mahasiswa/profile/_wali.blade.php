<div class="row">
    <div class="col-md-6">
        <h2 class="section-title">Biodata Wali</h2>
        <div class="dropdown-divider divider-red"></div>
        @foreach ($data->orangtua as $item)
            @if ($item->jenis != 'WALI')
                {{-- <p class="clearfix">
                    <span class="p-700 float-left">
                        Nama
                    </span>
                    <span class="float-right text-muted">-</span>
                </p>
                <p class="clearfix">
                    <span class="p-700 float-left">
                        NIK
                    </span>
                    <span class="float-right text-muted">-</span>
                </p>
                <p class="clearfix">
                    <span class="p-700 float-left">
                        Tanggal Lahir
                    </span>
                    <span class="float-right text-muted">-</span>
                </p>
                <p class="clearfix">
                    <span class="p-700 float-left">
                        Pendidikan Terakhir
                    </span>
                    <span class="float-right text-muted">-</span>
                </p>
                <p class="clearfix">
                    <span class="p-700 float-left">
                        Pekerjaan
                    </span>
                    <span class="float-right text-muted">-</span>
                </p>
                <p class="clearfix">
                    <span class="p-700 float-left">
                        Telepon
                    </span>
                    <span class="float-right text-muted">-</span>
                </p> --}}
                @continue
            @endif

            <p class="clearfix">
                <span class="p-700 float-left">
                    Nama
                </span>
                <span class="float-right text-muted">
                    {{$item->nama ?? '-'}}
                </span>
            </p>
            <p class="clearfix">
                <span class="p-700 float-left">
                    NIK
                </span>
                <span class="float-right text-muted">
                    {{$item->nik ?? '-'}}
                </span>
            </p>
            <p class="clearfix">
                <span class="p-700 float-left">
                    Tempat Lahir
                </span>
                <span class="float-right text-muted">
                    {{$item->tempat_lahir ?? '-'}}
                </span>
            </p>
            <p class="clearfix">
                <span class="p-700 float-left">
                    Tanggal Lahir
                </span>
                <span class="float-right text-muted">
                    {{ dateFormat($item->tanggal_lahir) ?? '-'}}
                </span>
            </p>
            <p class="clearfix">
                <span class="p-700 float-left">
                    Agama
                </span>
                <span class="float-right text-muted">
                    {{ $item->agama ?? '-'}}
                </span>
            </p>
            <p class="clearfix">
                <span class="p-700 float-left">
                    Pendidikan Terakhir
                </span>
                <span class="float-right text-muted">
                    {{ $item->pendidikan->name ?? '-'}}
                </span>
            </p>
            <p class="clearfix">
                <span class="p-700 float-left">
                    Pekerjaan
                </span>
                <span class="float-right text-muted">
                    {{ $item->pekerjaan ?? '-'}}
                </span>
            </p>
            <p class="clearfix">
                <span class="p-700 float-left">
                    Penghasilan
                </span>
                <span class="float-right text-muted">
                    {{ $item->penghasilan }}
                </span>
            </p>
            <p class="clearfix">
                <span class="p-700 float-left">
                    Telepon
                </span>
                <span class="float-right text-muted">
                    {{ $item->telp ?? '-'}}
                </span>
            </p>
            <p class="clearfix">
                <span class="p-700 float-left">
                    Alamat
                </span>
                <span class="float-right text-muted">
                    {{ $item->alamat ?? '-'}}
                </span>
            </p>
        @endforeach
    </div>
</div>