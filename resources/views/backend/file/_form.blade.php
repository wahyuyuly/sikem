<div class="row">
        <div class="col-md-6">
            {!! Form::hidden('id', $id, []) !!}
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">                                        
                        {!! Form::label('name', 'Nama Dokumen', ['class'=>'control-label']) !!}
                        {!! Form::text('name', null, ['class'=>$errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}
                        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="col-md-10">                                        
                    <div class="form-group">                                        
                        {!! Form::label('description', 'Keterangan Dokumen', ['class'=>'control-label']) !!} 
                        {!! Form::textarea('description', null, ['class'=>$errors->has('description') ? 'form-control is-invalid' : 'form-control', 'style'=>'min-height:90px']) !!}
                        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-10">                                
                    <div class="form-group">
                        {!! Form::label('file', 'Lampiran Dokumen', ['class'=>'control-label']) !!}
                        {!! Form::file('file', ['class'=>$errors->has('file') ? 'form-control is-invalid' : 'form-control']) !!}
                        <i style="font-size:8pt;">*Ukuran maksimal 25MB</i>
                        {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>