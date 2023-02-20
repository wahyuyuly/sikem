@extends('backend.layouts.app')

@section('content')
    <div class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Jurusan</h4>                            
                        </div>
                        {!! Form::model($data, ['route'=>['master-jurusan.update', $data->id], 'method'=>'patch']) !!}
                        <div class="card-body">
                            @alert
                            @endalert
                            @include('backend.pengaturan.jurusan._form')                            
                        </div>
                        <div class="card-footer">                            
                            <a href="{{ route('master-jurusan.index') }}"><button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-undo-alt"></i> Batal</button></a>
                            <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection