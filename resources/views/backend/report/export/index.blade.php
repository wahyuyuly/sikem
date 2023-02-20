@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

    <style>
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
                            <h4>Export Data Mahasiswa</h4>                            
                        </div>
                        {!! Form::open(['route'=>'export.create']) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('status', 'Status Mahasiswa', ['class'=>'control-label']) !!}
                                            {!! Form::select('status[]', ['AKTIF'=>'Mahasiswa Aktif', 'LULUS'=>'Alumni'], null, ['class' => $errors->has('status') ? 'multi-check form-control is-invalid' : 'multi-check form-control', 'multiple'=>'multiple']) !!}
                                            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('prodi_id', 'Program Studi', ['class'=>'control-label']) !!}
                                            {!! Form::select('prodi_id[]', $prodi, null, ['class' => $errors->has('prodi_id') ? 'multi-check form-control is-invalid' : 'multi-check form-control', 'multiple'=>'multiple']) !!}
                                            {!! $errors->first('prodi_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('tahun_masuk', 'Tahun Masuk', ['class'=>'control-label']) !!}
                                            <div class="input-group">
                                                {!! Form::text('tahun_start', null, ['placeholder' => 'Dari...', 'class' => $errors->has('tahun_start') ? 'form-control is-invalid' : 'form-control']) !!}
                                                {!! Form::text('tahun_end', null, ['placeholder' => 'Sampai...', 'class' => $errors->has('tahun_end') ? 'form-control is-invalid' : 'form-control']) !!}
                                                {!! $errors->first('tahun_start', '<div class="invalid-feedback">:message</div>') !!}
                                                {!! $errors->first('tahun_end', '<div class="invalid-feedback">:message</div>') !!}  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'control-label']) !!}
                                            {!! Form::select('jenis_kelamin[]', ['LAKI-LAKI'=>'Laki-Laki', 'PEREMPUAN'=>'Perempuan'], null, ['class' => $errors->has('jenis_kelamin') ? 'multi-check form-control is-invalid' : 'multi-check form-control', 'multiple'=>'multiple']) !!}
                                            {!! $errors->first('jenis_kelamin', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('agama', 'Agama', ['class'=>'control-label']) !!}
                                            {!! Form::select('agama[]', ['ISLAM'=>'ISLAM', 'KRISTEN'=>'KRISTEN', 'KATOLIK'=>'KATOLIK', 'HINDU'=>'HINDU', 'BUDHA'=>'BUDHA', 'KONGCHU'=>'KONGCHU', 'LAINYA'=>'LAINYA'], null, ['class' => $errors->has('agama') ? 'multi-check form-control is-invalid' : 'multi-check form-control', 'multiple'=>'multiple']) !!}
                                            {!! $errors->first('agama', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">                            
                                <a href="{{ route('home') }}"><button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-undo-alt"></i> Batal</button></a>
                                <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-print"></i> Export</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>

    <script>
        "use strict";
        var $multi = $('.multi-check');

        $(document).ready(function() {
            $multi.multipleSelect({
                filter: true,
                placeholder: 'Pilih'
            });
            $multi.multipleSelect('checkAll');
        });
    </script>
@endsection