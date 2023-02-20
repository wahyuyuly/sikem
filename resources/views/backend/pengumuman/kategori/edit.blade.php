@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/selectric/public/selectric.css') }}">
@endsection

@section('content')
<section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Kategori Pengumuman</h4>                            
                        </div>
                        {!! Form::model($data, ['route'=>['kategori-pengumuman.update', $data->id], 'method'=>'put']) !!}
                        <div class="card-body">
                            @alert
                            @endalert
                            @include('backend.pengumuman.kategori._form')                  
                        </div>
                        <div class="card-footer">                            
                            <a href="{{ route('kategori-pengumuman.index') }}"><button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-undo-alt"></i> Batal</button></a>
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
    <script src="{{ asset('assets/backend/vendor/selectric/public/jquery.selectric.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select').selectric();
        });
    </script>
@endsection