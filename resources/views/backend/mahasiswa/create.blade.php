@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

    <style>
        .selection .select2-selection {
            border-color: '#dc3545' !important;
        }

        .select2-container{ width: 100% !important; }

        .ms-choice {
            border: 0px solid #aaa;
        }

        .ms-choice>span {
            position:inherit;
        }
    </style>
@endsection

@section('content')
<section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Data Mahasiswa</h4>                            
                        </div>
                        {!! Form::open(['route'=>'mahasiswa.store', 'files'=>'true']) !!}
                        <div class="card-body">
                            @include('backend.components.alert')
                            
                            <ul class="nav nav-tabs" id="tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pribadi-tab" data-toggle="tab" href="#pribadi" role="tab" aria-controls="pribadi" aria-selected="true">Data Pribadi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="akademik-tab" data-toggle="tab" href="#akademik" role="tab" aria-controls="akademik" aria-selected="false">Akademik</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sekolah-tab" data-toggle="tab" href="#sekolah" role="tab" aria-controls="sekolah" aria-selected="false">Riwayat Sekolah</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ortu-tab" data-toggle="tab" href="#ortu" role="tab" aria-controls="ortu" aria-selected="false">Orang Tua</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="minat-tab" data-toggle="tab" href="#minat" role="tab" aria-controls="minat" aria-selected="false">Minat Bakat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="penyakit-tab" data-toggle="tab" href="#penyakit" role="tab" aria-controls="penyakit" aria-selected="false">Riwayat Sakit</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="asuransi-tab" data-toggle="tab" href="#asuransi-t" role="tab" aria-controls="asuransi-t" aria-selected="false">Jamkes & Kartu Pemerintah</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ortu-tab" data-toggle="tab" href="#akun" role="tab" aria-controls="akun" aria-selected="false">Akun Pengguna</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="pribadi" role="tabpanel" aria-labelledby="pribadi-tab">
                                    @include('backend.mahasiswa.inc._form', ['disable'=>true])
                                </div>
                                <div class="tab-pane fade" id="akademik" role="tabpanel" aria-labelledby="akademik-tab">
                                    @include('backend.mahasiswa.inc._akademik', ['disable'=>true])
                                </div>
                                <div class="tab-pane fade" id="sekolah" role="tabpanel" aria-labelledby="sekolah-tab">
                                    @include('backend.mahasiswa.inc._sekolah', ['disable'=>true])
                                </div>
                                <div class="tab-pane fade" id="ortu" role="tabpanel" aria-labelledby="ortu-tab">
                                    @include('backend.mahasiswa.inc._ortu', ['disable'=>true])
                                </div>
                                <div class="tab-pane fade" id="minat" role="tabpanel" aria-labelledby="minat-tab">
                                    @include('backend.mahasiswa.inc._minat-bakat', ['disable'=>true])
                                </div>
                                <div class="tab-pane fade" id="penyakit" role="tabpanel" aria-labelledby="penyakit-tab">
                                    @include('backend.mahasiswa.inc._penyakit', ['disable'=>true])
                                </div>
                                <div class="tab-pane fade" id="asuransi-t" role="tabpanel" aria-labelledby="asuransi-tab">
                                    @include('backend.mahasiswa.inc._asuransi', ['disable'=>true])
                                </div>
                                <div class="tab-pane fade" id="akun" role="tabpanel" aria-labelledby="akun-tab">
                                    @include('backend.mahasiswa.inc._akun', ['disable'=>true])
                                </div>
                            </div>                                                        
                        </div>
                        <div class="card-footer text-right">                            
                            <a href="{{ route('mahasiswa.index') }}"><button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-undo-alt"></i> Batal</button></a>
                            <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    @include('backend.mahasiswa._js')
@endsection