@extends('backend.layouts.app')

@section('css')
    
@endsection

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Import Data Mahasiswa</h4>                            
                    </div>
                    {!! Form::open(['url'=>route('mahasiswa.importstore'), 'files'=>true]) !!}
                    <div class="card-body">
                        @alert
                        @endalert
                        <div class="row">
                            <div class="col-md-4">                                
                                <div class="form-group">
                                    {!! Form::label('file', 'Berkas Excel', ['class'=>'control-label']) !!}
                                    {!! Form::file('file', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <span><a href="{{ asset('storage/format_import.xlsx') }}">* Contoh berkas</a></span>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-upload"></i> Import</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    
@endsection