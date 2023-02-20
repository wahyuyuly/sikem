{!! Form::hidden('id', $id) !!}
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">                                        
                    {!! Form::label('jenis', 'Prestasi', ['class'=>'control-label']) !!}                                    
                    {!! Form::select('jenis', [''=>'', 'AKADEMIK'=>'AKADEMIK', 'NON AKADEMIK'=>'NON AKADEMIK'], null, ['class'=>$errors->has('jenis') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('jenis', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">                                        
                    {!! Form::label('bidang', 'Bidang', ['class'=>'control-label']) !!}                                    
                    {!! Form::select('bidang', [''=>'', 'Ilmiah'=>'Ilmiah', 'Olahraga'=>'Olahraga', 'Seni'=>'Seni', 'Kepedulian Sosial'=>'Kepedulian Sosial', 'lain'=>'Lainnya'], isset($data) && $data->jenis == 'NON AKADEMIK' ? in_array($data->kategori, ['Ilmiah', 'Olahraga', 'Seni', 'Kepedulian Sosiali']) ? $data->kategori : 'lain' : null, [old('jenis') == 'NON AKADEMIK' || (isset($data) && $data->jenis == 'NON AKADEMIK') ? '' : 'disabled', 'class'=>$errors->has('bidang') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('bidang', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">                                        
                    {!! Form::label('kategori', 'Bidang Prestasi', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('kategori', null, [old('bidang') == 'lain' || (isset($data) && !in_array($data->kategori, ['Ilmiah', 'Olahraga', 'Seni', 'Kepedulian Sosiali'])) ? '' : 'readonly', 'placeholder'=>'Bidang...', 'class'=>$errors->has('kategori') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('kategori', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('nama', 'Nama Prestasi', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('nama', null, ['placeholder'=>'Nama...', 'class'=>$errors->has('nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('deskripsi', 'Keterangan', ['class'=>'control-label']) !!}                                    
                    {!! Form::textarea('deskripsi', null, ['style'=>'min-height:100px;', 'placeholder'=>'Keterangan...', 'class'=>$errors->has('deskripsi') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('deskripsi', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('file', 'Scan Sertifikat/dokumen lain', ['class'=>'control-label']) !!}                                    
                    {!! Form::file('file', ['class'=>$errors->has('file') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>