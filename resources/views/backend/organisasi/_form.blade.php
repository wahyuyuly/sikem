{!! Form::hidden('id', $id) !!}
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">                                        
                    {!! Form::label('nama', 'Nama Organisasi', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('nama', null, ['placeholder'=>'Nama...', 'class'=>$errors->has('nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('tahun_sk', 'Tahun Bergabung', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('tahun_sk', null, ['placeholder'=>'Tahun gabung...', 'class'=>$errors->has('tahun_sk') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('tahun_sk', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('file', 'Scan SK/Dokumen', ['class'=>'control-label']) !!}                                    
                    {!! Form::file('file', ['class'=>$errors->has('file') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>