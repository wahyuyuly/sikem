@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Riwayat Organisasi</h4>                            
                        </div>
                        {!! Form::open(['route'=>'organisasi.store', 'files'=>true]) !!}
                        <div class="card-body">
                            @include('backend.organisasi._form')                            
                        </div>
                        <div class="card-footer">                            
                            <a href="{{ route('organisasi.index') }}"><button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-undo-alt"></i> Kembali</button></a>
                            <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/vendor/select2/dist/js/select2.full.min.js') }}"></script>
    
    <script>
        "use strict";

        $(document).ready(function() {
            $('.choice').select2({
                placeholder: 'Pilih...'
            });
        });
    </script>
@endsection