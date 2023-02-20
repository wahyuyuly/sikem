<div class="row">
    <div class="col-md-6">
        <div class="row">
            @role(['super-admin', 'admin-jurusan'])
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('mahasiswa_id', 'Nama Mahasiswa', ['class'=>'control-label']) !!}
                    {!! Form::select('mahasiswa_id', [''=>''], null, ['class'=>$errors->has('mahasiswa_id') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('mahasiswa_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            @endrole 
            <div class="col-md-8">                                      
                <div class="form-group">                                        
                    {!! Form::label('jenis', 'Jenis Dokumen', ['class'=>'control-label']) !!} 
                    {!! Form::select('jenis', [''=>'', 'IJAZAH'=>'IJAZAH', 'SERTIFIKAT'=>'SERTIFIKAT', 'LAINNYA'=>'LAINNYA'], null, ['class'=>$errors->has('jenis') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('jenis', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">                                        
                <div class="form-group">                                        
                    {!! Form::label('keterangan', 'Keterangan Legalisir', ['class'=>'control-label']) !!} 
                    {!! Form::textarea('keterangan', null, ['class'=>$errors->has('keterangan') ? 'form-control is-invalid' : 'form-control', 'style'=>'min-height:90px']) !!}
                    {!! $errors->first('keterangan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            @role(['super-admin', 'admin-jurusan'])
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('npm', 'NPM', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('npm', null, ['disabled','placeholder'=>'NPM Mahasiswa...', 'class'=>$errors->has('npm') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('npm', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            @endrole
            <div class="col-md-10">                                
                <div class="form-group">
                    {!! Form::label('file', 'Lampiran Dokumen', ['class'=>'control-label']) !!}
                    {!! Form::file('file', ['class'=>$errors->has('file') ? 'form-control is-invalid' : 'form-control']) !!}
                    <i style="font-size:8pt;">*Tipe berkas PDF dan ukuran maksimal 3MB</i>
                    {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>