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
                            <h4>Tambah Capaian Prestasi</h4>                            
                        </div>
                        {!! Form::open(['route'=>'prestasi.store', 'files'=>true]) !!}
                        <div class="card-body">
                            @include('backend.prestasi._form')                            
                        </div>
                        <div class="card-footer">                            
                            <a href="{{ route('prestasi.index') }}"><button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-undo-alt"></i> Kembali</button></a>
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
                placeholder: 'Pilih...',
                minimumResultsForSearch: Infinity
            });

            $('#jenis').on('select2:select', function(e) {                
                var val = e.params.data;
                if(val.id == 'NON AKADEMIK') {
                    $('#bidang').prop('disabled', false);                    
                } else {
                    $('#bidang').val(null).trigger('change');
                    $('#bidang').prop('disabled', true);
                    $('#kategori').val('');
                    $('#kategori').attr('readonly', true);
                }
            });

            $('#bidang').on('select2:select', function(e) {
                var data = e.params.data;
                if(data.id != 'lain') {
                    $('#kategori').val(data.id);
                    $('#kategori').attr('readonly', true);
                } else {
                    $('#kategori').val('');
                    $('#kategori').removeAttr('readonly');
                }
            });
        });
    </script>
@endsection