@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/selectric/public/selectric.css') }}">
@endsection

@section('content')
<section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Pengguna Aplikasi</h4>                            
                        </div>
                        {!! Form::open(['route'=>'pengguna.store', 'files'=>'true']) !!}
                        <div class="card-body">
                            @include('backend.pengaturan.pengguna._form', ['disable'=>false])                            
                        </div>
                        <div class="card-footer">                            
                            <a href="{{ route('pengguna.index') }}"><button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-undo-alt"></i> Batal</button></a>
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
    <script src="{{ asset('assets/backend/vendor/selectric/public/jquery.selectric.min.js') }}"></script>
    @include('backend.pengaturan.pengguna._js')
@endsection