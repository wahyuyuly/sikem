<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('nama', 'Nama Mahasiswa', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('nama', null, ['placeholder'=>'Nama mahasiswa...', 'class'=>$errors->has('nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('nama_panggilan', 'Nama Panggilan', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('nama_panggilan', null, ['placeholder'=>'Nama panggilan...', 'class'=>$errors->has('nama_panggilan') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('nama_panggilan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('npm', 'NIM', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('npm', null, ['placeholder'=>'NIM Mahasiswa...', 'class'=>$errors->has('npm') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('npm', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('nik', 'NIK Mahasiswa', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('nik', null, ['placeholder'=>'Nomor Induk Kependudukan...', 'class'=>$errors->has('nik') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('nik', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'control-label']) !!} 
                    {!! Form::select('jenis_kelamin', [''=>'', 'LAKI-LAKI'=>'LAKI-LAKI', 'PEREMPUAN'=>'PEREMPUAN'], null, ['class'=>$errors->has('jenis_kelamin') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('jenis_kelamin', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('tempat_lahir', null, ['placeholder'=>'Tempat lahir...', 'class'=>$errors->has('tempat_lahir') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('tempat_lahir', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>          
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('tanggal_lahir', null, ['placeholder'=>'dd-mm-yyyy', 'autocomplete'=>'off', 'class'=>$errors->has('tanggal_lahir') ? 'form-control tanggal is-invalid' : 'form-control tanggal']) !!}
                    {!! $errors->first('tanggal_lahir', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('agama', 'Agama', ['class'=>'control-label']) !!}
                    {!! Form::select('agama', [''=>'', 'ISLAM'=>'ISLAM', 'KRISTEN'=>'KRISTEN', 'KATOLIK'=>'KATOLIK', 'HINDU'=>'HINDU', 'BUDHA'=>'BUDHA', 'LAINYA'=>'LAINYA'], null, ['class'=>$errors->has('agama') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('agama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('suku_bangsa', 'Suku Bangsa', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('suku_bangsa', null, ['placeholder'=>'Suku bangsa...', 'class'=>$errors->has('suku_bangsa') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('suku_bangsa', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('golongan_darah', 'Golongan Darah', ['class'=>'control-label']) !!} 
                    {!! Form::select('golongan_darah', [''=>'', 'A'=>'A', 'B'=>'B', 'AB'=>'AB', 'O'=>'O'], null, ['class'=>$errors->has('golongan_darah') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('golongan_darah', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('rhesus', 'Rhesus', ['class'=>'control-label']) !!}
                    {!! Form::select('rhesus', [''=>'', 'POSITIF'=>'POSITIF', 'NEGATIF'=>'NEGATIF'], null, ['class'=>$errors->has('rhesus') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('rhesus', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group">
                    {!! Form::label('anak_ke', 'Anak Ke', ['class'=>'control-label']) !!}
                    {!! Form::text('anak_ke', null, ['class'=>$errors->has('anak_ke') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('anak_ke', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    {!! Form::label('jumlah_saudara', 'Jumlah Saudara', ['class'=>'control-label']) !!}
                    {!! Form::text('jumlah_saudara', null, ['class'=>$errors->has('jumlah_saudara') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('jumlah_saudara', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group">
                    {!! Form::label('tinggi_badan', 'Tinggi Badan', ['class'=>'control-label']) !!}
                    <div class="input-group">                        
                        {!! Form::text('tinggi_badan', null, ['class'=>'form-control']) !!}
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span>CM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    {!! Form::label('berat_badan', 'Berat Badan', ['class'=>'control-label']) !!}
                    <div class="input-group">                        
                        {!! Form::text('berat_badan', null, ['class'=>'form-control']) !!}
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span>KG</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('telp', 'Telepon', ['class'=>'control-label']) !!}
                    {!! Form::text('telp', null, ['placeholder'=>'Nomor telepon...', 'class'=>$errors->has('telp') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('telp', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="section-title">&bull; Alamat Sesuai KTP/KK</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">                                        
                    {!! Form::label('alamat', 'Alamat', ['class'=>'control-label']) !!}                                        
                    {!! Form::textarea('alamat', null, ['placeholder'=>'Alamat...', 'class'=>$errors->has('alamat') ? 'form-control is-invalid' : 'form-control', 'style'=>'height:100px !important;']) !!}
                    {!! $errors->first('alamat', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('provinsi_id', 'Provinsi', ['class'=>'control-label']) !!} 
                    {!! Form::select('provinsi_id', [''=>''], null, ['class'=>$errors->has('provinsi_id') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('provinsi_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('kota_id', 'Kota/Kabupaten', ['class'=>'control-label']) !!} 
                    {!! Form::select('kota_id', [''=>''], null, [!empty($data->kelurahan) ? '' : 'disabled', 'class'=>$errors->has('kota_id') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('kota_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('kecamatan_id', 'Kecamatan', ['class'=>'control-label']) !!} 
                    {!! Form::select('kecamatan_id', [''=>''], null, [!empty($data->kelurahan) ? '' : 'disabled', 'class'=>$errors->has('kecamatan_id') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('kecamatan_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('kelurahan_id', 'Kelurahan/Desa', ['class'=>'control-label']) !!} 
                    {!! Form::select('kelurahan_id', [''=>''], null, [!empty($data->kelurahan) ? '' : 'disabled', 'class'=>$errors->has('kelurahan_id') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('kelurahan_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="section-title">&bull; Alamat Selama Pendidikan</div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">                                        
                    {!! Form::label('alamat_tinggal', 'Alamat', ['class'=>'control-label']) !!}                                        
                    {!! Form::textarea('alamat_tinggal', null, ['placeholder'=>'Alamat...', 'class'=>$errors->has('alamat_tinggal') ? 'form-control is-invalid' : 'form-control', 'style'=>'height:100px !important;']) !!}
                    {!! $errors->first('alamat_tinggal', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('status_tinggal', 'Status Tempat Tinggal', ['class'=>'control-label']) !!} 
                    {!! Form::select('status_tinggal', [''=>'', 'Rumah Orang Tua'=>'Rumah Orang Tua', 'Asrama'=>'Asrama', 'Kost'=>'Kost', 'Tempat Famili'=>'Tempat Famili'], null, ['class'=>$errors->has('status_tinggal') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('status_tinggal', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('provinsi_tinggal', 'Provinsi', ['class'=>'control-label']) !!} 
                    {!! Form::select('provinsi_tinggal', [''=>''], null, ['class'=>$errors->has('provinsi_tinggal') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('provinsi_tinggal', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('kota_tinggal', 'Kota/Kabupaten', ['class'=>'control-label']) !!} 
                    {!! Form::select('kota_tinggal', [''=>''], null, [!empty($data->kelurahan_domisili) ? '' : 'disabled', 'class'=>$errors->has('kota_tinggal') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('kota_tinggal', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('kecamatan_tinggal', 'Kecamatan', ['class'=>'control-label']) !!} 
                    {!! Form::select('kecamatan_tinggal', [''=>''], null, [!empty($data->kelurahan_domisili) ? '' : 'disabled', 'class'=>$errors->has('kecamatan_tinggal') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('kecamatan_tinggal', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('kelurahan_tinggal', 'Kelurahan/Desa', ['class'=>'control-label']) !!} 
                    {!! Form::select('kelurahan_tinggal', [''=>''], null, [!empty($data->kelurahan_domisili) ? '' : 'disabled', 'class'=>$errors->has('kelurahan_tinggal') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('kelurahan_tinggal', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>