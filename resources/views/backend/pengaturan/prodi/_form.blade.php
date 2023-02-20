<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('jurusan_id', 'Jurusan', ['class'=>'control-label']) !!}
                    {!! Form::select('jurusan_id', [''=>'']+$jurusan, null, ['class'=>$errors->has('jurusan_id') ? 'form-control choice is-invalid' : 'form-control choice-s']) !!}
                    {!! $errors->first('jurusan_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('tingkat_id', 'Tingkat Pendidikan', ['class'=>'control-label']) !!}
                    {!! Form::select('tingkat_id', [''=>'']+$tingkat, null, ['class'=>$errors->has('tingkat_id') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('tingkat_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">                                        
                    {!! Form::label('name', 'Program Studi', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('name', null, ['placeholder'=>'Nama program studi...', 'class'=>$errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">                                        
                    {!! Form::label('description', 'Keterangan', ['class'=>'control-label']) !!}                                    
                    {!! Form::textarea('description', null, ['style'=>'min-height:100px;', 'placeholder'=>'Keterangan...', 'class'=>$errors->has('description') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>