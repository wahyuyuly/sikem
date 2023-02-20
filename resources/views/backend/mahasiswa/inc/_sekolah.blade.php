<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title">&bull; Sekolah Dasar (SD)</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">                                        
                    {!! Form::label('sd[nama]', 'Nama Sekolah', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('sd[nama]', null, ['placeholder'=>'Nama Sekolah...', 'class'=>$errors->has('sd.nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sd.nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="offset-md-1 col-md-3">
                <div class="form-group">                                        
                    {!! Form::label('sd[nilai]', 'Rerata Nilai', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('sd[nilai]', null, ['placeholder'=>'Nilai...', 'class'=>$errors->has('sd.nilai') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sd.nilai', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">                                        
                    {!! Form::label('sd[tahun_masuk]', 'Tahun Masuk', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('sd[tahun_masuk]', null, ['placeholder'=>'Tahun masuk...', 'class'=>$errors->has('sd.tahun_masuk') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sd.tahun_masuk', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">                                        
                    {!! Form::label('sd[tahun_lulus]', 'Tahun Lulus', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('sd[tahun_lulus]', null, ['placeholder'=>'Tahun lulus...', 'class'=>$errors->has('sd.tahun_lulus') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sd.tahun_lulus', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="offset-md-2 col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('sd[ijazah]', 'Scan Ijazah', ['class'=>'control-label']) !!}                                        
                    {!! Form::file('sd[ijazah]', ['class'=>$errors->has('sd.ijazah') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sd.ijazah', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title">&bull; Sekolah Menengah Pertama (SMP)</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">                                        
                    {!! Form::label('smp[nama]', 'Nama Sekolah', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('smp[nama]', null, ['placeholder'=>'Nama Sekolah...', 'class'=>$errors->has('smp.nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('smp.nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="offset-md-1 col-md-3">
                <div class="form-group">                                        
                    {!! Form::label('smp[nilai]', 'Rerata Nilai', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('smp[nilai]', null, ['placeholder'=>'Nilai...', 'class'=>$errors->has('smp.nilai') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('smp.nilai', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">                                        
                    {!! Form::label('smp[tahun_masuk]', 'Tahun Masuk', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('smp[tahun_masuk]', null, ['placeholder'=>'Tahun masuk...', 'class'=>$errors->has('smp.tahun_masuk') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('smp.tahun_masuk', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">                                        
                    {!! Form::label('smp[tahun_lulus]', 'Tahun Lulus', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('smp[tahun_lulus]', null, ['placeholder'=>'Tahun lulus...', 'class'=>$errors->has('smp.tahun_lulus') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('smp.tahun_lulus', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="offset-md-2 col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('smp[ijazah]', 'Scan Ijazah', ['class'=>'control-label']) !!}                                        
                    {!! Form::file('smp[ijazah]', ['class'=>$errors->has('smp.ijazah') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('smp.ijazah', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title">&bull; Sekolah Menengah Atas/Sederajat (SMA/MA/SMK)</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('sma[sma]', 'Bidang Sekolah', ['class'=>'control-label']) !!} 
                    {!! Form::select('sma[sma]', [''=>'', 'SMA'=>'SMA', 'MA'=>'MA', 'SMK'=>'SMK', 'PAKET C'=>'PAKET C'], null, ['class'=>$errors->has('sma.sma') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('sma.sma', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="offset-md-2 col-md-5">
                <div class="form-group">                                        
                    {!! Form::label('sma[jurusan]', 'Jurusan', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('sma[jurusan]', null, ['placeholder'=>'Jurusan...', 'class'=>$errors->has('sma.jurusan') ? 'form-control is-invalid' : 'form-control']) !!}
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        IPA, IPS, Bahasa, Akuntansi, dll.
                    </small>
                    {!! $errors->first('sma.jurusan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">                                        
                    {!! Form::label('sma[nama]', 'Nama Sekolah', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('sma[nama]', null, ['placeholder'=>'Nama Sekolah...', 'class'=>$errors->has('sma.nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sma.nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="offset-md-1 col-md-3">
                <div class="form-group">                                        
                    {!! Form::label('sma[nilai]', 'Rerata Nilai', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('sma[nilai]', null, ['placeholder'=>'Nilai...', 'class'=>$errors->has('sma.nilai') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sma.nilai', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">                                        
                    {!! Form::label('sma[tahun_masuk]', 'Tahun Masuk', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('sma[tahun_masuk]', null, ['placeholder'=>'Tahun masuk...', 'class'=>$errors->has('sma.tahun_masuk') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sma.tahun_masuk', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">                                        
                    {!! Form::label('sma[tahun_lulus]', 'Tahun Lulus', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('sma[tahun_lulus]', null, ['placeholder'=>'Tahun lulus...', 'class'=>$errors->has('sma.tahun_lulus') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sma.tahun_lulus', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="offset-md-2 col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('sma[ijazah]', 'Scan Ijazah', ['class'=>'control-label']) !!}                                        
                    {!! Form::file('sma[ijazah]', ['class'=>$errors->has('sma.ijazah') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('sma.ijazah', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>