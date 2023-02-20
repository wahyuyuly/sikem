@extends('backend.layouts.app')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Dokumen</h4>
                        </div>
                        {!! Form::open(['url'=>route('files.store'), 'files'=>'true']) !!}
                        <div class="card-body">
                            @include('backend.file._form')                            
                        </div>
                        <div class="card-footer">                            
                            <a href="{{ route('files.index') }}"><button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-undo-alt"></i> Kembali</button></a>
                            <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection