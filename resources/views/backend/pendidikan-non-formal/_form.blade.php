{!! Form::hidden('id', $id) !!}
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">                                        
                    {!! Form::label('jenis', 'Jenis Pendidikan Non Formal', ['class'=>'control-label']) !!}                                    
                    {!! Form::select('jenis', [''=>'', 'PELATIHAN'=>'PELATIHAN', 'KURSUS'=>'KURSUS', 'WORKSHOP'=>'WORKSHOP', 'SEMINAR'=>'SEMINAR'], null, ['class'=>$errors->has('jenis') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('jenis', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('nama', 'Nama Pelatihan\Kursus\Kegiatan', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('nama', null, ['placeholder'=>'Nama...', 'class'=>$errors->has('nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div> 
        </div>
        <div class="row">                
            <div class="col-md-6">
                <div class="form-group">                                        
                    {!! Form::label('penyelenggara', 'Nama Penyelenggara', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('penyelenggara', null, ['placeholder'=>'Penyelanggara...', 'class'=>$errors->has('penyelenggara') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('penyelenggara', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('tanggal', 'Tanggal Pelaksanaan', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('tanggal', null, ['placeholder'=>'Tanggal...', 'class'=>$errors->has('tanggal') ? 'form-control datepicker is-invalid' : 'form-control datepicker']) !!}
                    {!! $errors->first('tanggal', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('lama', 'Lama pelaksanaan', ['class'=>'control-label']) !!}
                    <div class="input-group">
                        {!! Form::text('lama', null, ['placeholder'=>'Lama...', 'class'=>$errors->has('lama') ? 'form-control is-invalid' : 'form-control']) !!}
                        {!! Form::select('satuan', ['HARI'=>'HARI', 'MINGGU'=>'MINGGU', 'BULAN'=>'BULAN', 'TAHUN'=>'TAHUN'], null, ['class'=>$errors->has('satuan') ? 'form-control choice is-invalid' : 'form-control choice']) !!}                        
                        {!! $errors->first('lama', '<div class="invalid-feedback">:message</div>') !!}
                        {!! $errors->first('satuan', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('file', 'Scan Sertifikat/Dokumen Lainnya', ['class'=>'control-label']) !!}                                    
                    {!! Form::file('file', ['class'=>$errors->has('file') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>