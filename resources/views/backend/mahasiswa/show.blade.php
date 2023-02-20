@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                @if(!empty($data->account->photo))
                                    <img alt="image" src="{{ asset('storage/photos/'.$data->account->photo) }}" class="rounded-circle author-box-picture" style="width:100px; height: 100px;">
                                @else
                                    <img alt="image" src="{{ asset('assets/img/foto-m.png') }}" class="rounded-circle author-box-picture" style="width:100px; height: 100px;">                                
                                @endif
                                <div class="clearfix"></div>
                                <div class="author-box-name mt-md-2">
                                    <a href="#">{{ $data->nama }}</a>
                                </div>
                                <div class="author-box-job">{{ $data->prodi->name ?? '-' }}</div>
                            </div>
                            <div class="text-center">
                                <div class="col-md-12 mt-md-4">
                                    <a href="{{ route('mahasiswa.edit', $data->id) }}" class="btn btn-sm btn-warning btn-icon icon-left"><i class="far fa-edit"></i> Edit Data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Alamat</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                        Telepon :
                                    </span></br>
                                    <span class="float-left text-muted">
                                        {{$data->telp ?? '-'}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                        Alamat :
                                    </span></br>
                                    <span class="float-left text-muted">
                                        {{$data->alamat ?? '-'}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                        Provinsi :
                                    </span></br>
                                    <span class="float-left text-muted">
                                        {{$data->kelurahan->kecamatan->kota->provinsi->name ?? '-'}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                        Kota/Kabupaten :
                                    </span></br>
                                    <span class="float-left text-muted">
                                            {{$data->kelurahan->kecamatan->kota->name ?? '-'}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                       Kecamatan :
                                    </span></br>
                                    <span class="float-left text-muted">
                                            {{$data->kelurahan->kecamatan->name ?? '-'}}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Alamat Tinggal</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                        Status Tinggal :
                                    </span></br>
                                    <span class="float-left text-muted">
                                        {{$data->status_tinggal ?? '-'}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                        Alamat :
                                    </span></br>
                                    <span class="float-left text-muted">
                                        {{$data->alamat_tinggal ?? '-'}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                        Provinsi :
                                    </span></br>
                                    <span class="float-left text-muted">
                                        {{$data->kelurahan_domisili->kecamatan->kota->provinsi->name ?? '-'}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                        Kota/Kabupaten :
                                    </span></br>
                                    <span class="float-left text-muted">
                                            {{$data->kelurahan_domisili->kecamatan->kota->name ?? '-'}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="p-700 float-left">
                                       Kecamatan :
                                    </span></br>
                                    <span class="float-left text-muted">
                                            {{$data->kelurahan_domisili->kecamatan->name ?? '-'}}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Informasi Mahasiswa</h4>
                        </div>
                        <div class="card-body">                            
                            @alert
                            @endalert
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Nama Lengkap
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->nama ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Nama Panggilan
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->nama_panggilan ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                NIK
                                            </span>
                                            <span class="float-right text-muted text-info">
                                                {{$data->nik ?? ''}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Tanggal Lahir
                                            </span>
                                            <span class="float-right text-muted text-info">
                                                {{$data->tanggal_lahir ?? ''}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Tempat Lahir
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->tempat_lahir}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                            Jenis Kelamin
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->jenis_kelamin ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Agama
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->agama ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Suku Bangsa
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->suku_bangsa ?? '-'}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Golongan Darah
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->golongan_darah ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Rhesus
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->rhesus ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Tinggi Badan
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->tinggi_badan ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Berat Badan
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->berat_badan ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Anak Ke
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->anak_ke ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Jumlah Saudara
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->jumlah_saudara ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Email
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->account->email ?? '-'}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                NIM
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->npm ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Jenjang Pendidikan
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->prodi->tingkat->name ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Jurusan
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->prodi->jurusan->name ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Program Studi
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->prodi->name ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Tahun Masuk
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->tahun_masuk ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Jalur Penerimaan
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->jalur_penerimaan ?? '-'}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Status
                                            </span>
                                            <span class="float-right text-muted">
                                                {{$data->status ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Tanggal Yudisium
                                            </span>
                                            <span class="float-right text-muted">
                                                {{ $data->tanggal_yudisium != null ? dateFormat($data->tanggal_yudisium) : '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Minat UKM
                                            </span>
                                            <span class="float-right text-muted">
                                                {{ $data->minat->ukm ?? '-' }}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Minat Study Exchange
                                            </span>
                                            <span class="float-right text-muted">
                                                {{ $data->minat->exchange ?? '-'}}
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="p-700 float-left text-info">
                                                Minat Kerja di Luar Negeri
                                            </span>
                                            <span class="float-right text-muted">
                                                {{ $data->minat->overseas ?? 'Tidak'}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="orangtua-tab" data-toggle="tab" href="#orangtua" role="tab" aria-controls="orangtua" aria-selected="true">Orang Tua</a>
                                </li>                                
                                <li class="nav-item">
                                    <a class="nav-link" id="wali-tab" data-toggle="tab" href="#wali" role="tab" aria-controls="wali" aria-selected="false">Wali</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false">Pendidikan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#sakit" role="tab" aria-controls="sakit" aria-selected="false">Riwayat Sakit</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTabContent2">
                                <div class="tab-pane fade active show" id="orangtua" role="tabpanel" aria-labelledby="orangtua">
                                    @include('backend.mahasiswa.profile._orangtua')                          
                                </div>
                                <div class="tab-pane fade" id="wali" role="tabpanel" aria-labelledby="wali">
                                    @include('backend.mahasiswa.profile._wali')
                                </div>
                                <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan">
                                    @include('backend.mahasiswa.profile._pendidikan')
                                </div>
                                <div class="tab-pane fade" id="sakit" role="tabpanel" aria-labelledby="sakit">
                                    @include('backend.mahasiswa.profile._sakit')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/sweetalert/sweetalert.min.js') }}"></script>
    
    <script>
        "use strict"
        
        $(".dataList").dataTable({            
            language: {
                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
            },
            "columnDefs": [
                { "sortable": false, "targets": [2, 3] }
            ]
        });
    </script>
@endsection