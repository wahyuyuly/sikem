<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">                                        
                    {!! Form::label('name', 'Nama Jurusan', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('name', null, ['placeholder'=>'Nama jurusan...', 'class'=>$errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}
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