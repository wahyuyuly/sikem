<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('name', 'Judul Kategori', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('name', null, ['placeholder'=>'Judul kategori...', 'class'=>$errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('description', 'Deskripsi', ['class'=>'control-label']) !!}                                        
                    {!! Form::textarea('description', null, ['style'=>'min-height:100px;', 'class'=>$errors->has('description') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('status', 'Status', ['class'=>'control-label']) !!} 
                    {!! Form::select('status', ['active'=>'AKTIF', 'non-active'=>'TIDAK AKTIF'], null, ['class'=>$errors->has('status') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>