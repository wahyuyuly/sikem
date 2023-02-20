<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('prodi_id', 'Program Studi', ['class'=>'control-label']) !!}
                    {!! Form::select('prodi_id', [''=>'']+$prodi, isset($data->prodi_id) ? $data->prodi_id : null, ['class'=>$errors->has('prodi_id') ? 'form-control choice-s is-invalid' : 'form-control choice-s']) !!}
                    {!! $errors->first('prodi_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">                                        
                    {!! Form::label('tahun_masuk', 'Tahun Masuk', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('tahun_masuk', null, ['placeholder'=>'...', 'class'=>$errors->has('tahun_masuk') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('tahun_masuk', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">              
                    {!! Form::label('jalur_penerimaan', 'Jalur Penerimaan', ['class'=>'control-label']) !!}
                    {!! Form::select('jalur_penerimaan', [''=>'', 'PMDP'=>'PMDP', 'Jalur SIMAMA/Uji Tulis Gelombang 1'=>'Jalur SIMAMA/Uji Tulis Gelombang 1', 'Jalur Mandiri/Uji Tulis Gelombang 2'=>'Jalur Mandiri/Uji Tulis Gelombang 2', 'Alih Jenjang'=>'Alih Jenjang', 'Profesi'=>'Profesi', 'RPL'=>'RPL'], null, ['class'=>$errors->has('jalur_penerimaan') ? 'form-control choice-s is-invalid' : 'form-control choice-s']) !!}
                    {!! $errors->first('jalur_penerimaan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">                                    
                    {!! Form::label('status', 'Status', ['class'=>'control-label']) !!} 
                    {!! Form::select('status', [''=>'', 'AKTIF'=>'AKTIF', 'MENGUNDURKAN DIRI'=>'MENGUNDURKAN DIRI', 'DO'=>'DO', 'LULUS'=>'LULUS'], null, ['class'=>$errors->has('status') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('tanggal_yudisium', 'Tanggal Yudisium', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('tanggal_yudisium', null, ['placeholder'=>'dd-mm-yyyy', 'autocomplete'=>'off', 'class'=>$errors->has('tanggal_yudisium') ? 'form-control tanggal is-invalid' : 'form-control tanggal']) !!}
                    {!! $errors->first('tanggal_yudisium', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>