<div class="row">
    <div class="col-md-6">
        <div class="section-title">&bull; Biodata Bapak</div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            {!! Form::hidden('bapak[jenis]', 'BAPAK', null) !!}
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('bapak[nama]', 'Nama Bapak', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('bapak[nama]', !empty($data->bapak) ? $data->bapak->nama : null, ['placeholder'=>'Nama Bapak...', 'class'=>$errors->has('bapak.nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('bapak.nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('bapak[tempat_lahir]', 'Tempat Lahir', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('bapak[tempat_lahir]', !empty($data->bapak) ? $data->bapak->tempat_lahir : null, ['placeholder'=>'Tempat lahir bapak...', 'class'=>$errors->has('bapak.tempat_lahir') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('bapak.tempat_lahir', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('bapak[tanggal_lahir]', 'Tanggal Lahir', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('bapak[tanggal_lahir]', !empty($data->bapak) ? $data->bapak->tanggal_lahir : null, ['placeholder'=>'dd-mm-yyyy', 'autocomplete'=>'off', 'class'=>$errors->has('bapak.tanggal_lahir') ? 'form-control tanggal is-invalid' : 'form-control tanggal']) !!}
                    {!! $errors->first('bapak.tanggal_lahir', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('bapak[agama]', 'Agama', ['class'=>'control-label']) !!}
                    {!! Form::select('bapak[agama]', [''=>'', 'ISLAM'=>'ISLAM', 'KRISTEN'=>'KRISTEN', 'KATOLIK'=>'KATOLIK', 'HINDU'=>'HINDU', 'BUDHA'=>'BUDHA', 'LAINYA'=>'LAINYA'], null, ['class'=>$errors->has('ibu.agama') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('bapak.agama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('bapak[pendidikan_id]', 'Pendidikan', ['class'=>'control-label']) !!} 
                    {!! Form::select('bapak[pendidikan_id]', [''=>'']+$pendidikan, !empty($data->bapak) ? $data->bapak->pendidikan_id : null, ['class'=>$errors->has('bapak.pendidikan_id') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('bapak.pendidikan_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            {!! Form::hidden('ibu[jenis]', 'IBU', null) !!}            
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('bapak[nik]', 'NIK Bapak', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('bapak[nik]', !empty($data->bapak) ? $data->bapak->nik : null, ['placeholder'=>'Nomor Induk Kependudukan...', 'class'=>$errors->has('bapak.nik') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('bapak.nik', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('bapak[telp]', 'Telp. Bapak', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('bapak[telp]', !empty($data->bapak) ? $data->bapak->telp : null, ['placeholder'=>'Nomor telepon...', 'class'=>$errors->has('bapak.telp') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('bapak.telp', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('bapak[pekerjaan]', 'Pekerjaan', ['class'=>'control-label']) !!} 
                    {!! Form::select('bapak[pekerjaan]', [''=>'', 'TIDAK BEKERJA'=>'TIDAK BEKERJA', 'SWASTA'=>'SWASTA', 'WIRASWASTA'=>'WIRASWASTA', 'BURUH'=>'BURUH', 'PETANI'=>'PETANI', 'PNS'=>'PNS', 'POLRI'=>'POLRI', 'TNI'=>'TNI', 'PENSIUNAN PNS/POLRI/TNI'=>'PENSIUNAN PNS/POLRI/TNI', 'SUDAH MENINGGAL'=>'SUDAH MENINGGAL', 'LAINNYA'=>'LAINNYA'], !empty($data->bapak) ? $data->bapak->pekerjaan : null, ['class'=>$errors->has('bapak.pekerjaan') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('bapak.pekerjaan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('bapak[penghasilan]', 'Penghasilan', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('bapak[penghasilan]', !empty($data->bapak) ? $data->bapak->penghasilan : null, ['placeholder'=>'Penghasilan...', 'class'=>$errors->has('bapak.penghasilan') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('bapak.penghasilan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('bapak[alamat]', 'Alamat Bapak', ['class'=>'control-label']) !!}                                        
                    {!! Form::textarea('bapak[alamat]', !empty($data->bapak) ? $data->bapak->alamat : null, ['placeholder'=>'Alamat...', 'class'=>$errors->has('bapak.alamat') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('bapak.alamat', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>  
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="section-title">&bull; Biodata Ibu</div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            {!! Form::hidden('ibu[jenis]', 'IBU', null) !!}
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('ibu[nama]', 'Nama Ibu', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('ibu[nama]', !empty($data->ibu) ? $data->ibu->nama : null, ['placeholder'=>'Nama Ibu...', 'class'=>$errors->has('ibu.nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('ibu.nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('ibu[tempat_lahir]', 'Tempat Lahir', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('ibu[tempat_lahir]', !empty($data->ibu) ? $data->ibu->tempat_lahir : null, ['placeholder'=>'Tempat lahir ibu...', 'class'=>$errors->has('ibu.tempat_lahir') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('ibu.tempat_lahir', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('ibu[tanggal_lahir]', 'Tanggal Lahir', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('ibu[tanggal_lahir]', !empty($data->ibu) ? $data->ibu->tanggal_lahir : null, ['placeholder'=>'dd-mm-yyyy', 'autocomplete'=>'off', 'class'=>$errors->has('ibu.tanggal_lahir') ? 'form-control tanggal is-invalid' : 'form-control tanggal']) !!}
                    {!! $errors->first('ibu.tanggal_lahir', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('ibu[agama]', 'Agama', ['class'=>'control-label']) !!}
                    {!! Form::select('ibu[agama]', [''=>'', 'ISLAM'=>'ISLAM', 'KRISTEN'=>'KRISTEN', 'KATOLIK'=>'KATOLIK', 'HINDU'=>'HINDU', 'BUDHA'=>'BUDHA', 'LAINYA'=>'LAINYA'], null, ['class'=>$errors->has('ibu.agama') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('ibu.agama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('ibu[pendidikan_id]', 'Pendidikan', ['class'=>'control-label']) !!} 
                    {!! Form::select('ibu[pendidikan_id]', [''=>'']+$pendidikan, !empty($data->ibu) ? $data->ibu->pendidikan_id : null, ['class'=>$errors->has('ibu.pendidikan_id') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('ibu.pendidikan_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            {!! Form::hidden('ibu[jenis]', 'IBU', null) !!}            
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('ibu[nik]', 'NIK Ibu', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('ibu[nik]', !empty($data->ibu) ? $data->ibu->nik : null, ['placeholder'=>'Nomor Induk Kependudukan...', 'class'=>$errors->has('ibu.nik') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('ibu.nik', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('ibu[telp]', 'Telp. Ibu', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('ibu[telp]', !empty($data->ibu) ? $data->ibu->telp : null, ['placeholder'=>'Nomor telepon...', 'class'=>$errors->has('ibu.telp') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('ibu.telp', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('ibu[pekerjaan]', 'Pekerjaan', ['class'=>'control-label']) !!} 
                    {!! Form::select('ibu[pekerjaan]', [''=>'', 'TIDAK BEKERJA'=>'TIDAK BEKERJA', 'SWASTA'=>'SWASTA', 'WIRASWASTA'=>'WIRASWASTA', 'BURUH'=>'BURUH', 'PETANI'=>'PETANI', 'PNS'=>'PNS', 'POLRI'=>'POLRI', 'TNI'=>'TNI', 'PENSIUNAN PNS/POLRI/TNI'=>'PENSIUNAN PNS/POLRI/TNI', 'SUDAH MENINGGAL'=>'SUDAH MENINGGAL', 'LAINNYA'=>'LAINNYA'], !empty($data->ibu) ? $data->ibu->pekerjaan : null, ['class'=>$errors->has('ibu.pekerjaan') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('ibu.pekerjaan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('ibu[penghasilan]', 'Penghasilan', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('ibu[penghasilan]', !empty($data->ibu) ? $data->ibu->penghasilan : null, ['placeholder'=>'Penghasilan...', 'class'=>$errors->has('ibu.penghasilan') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('ibu.penghasilan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('ibu[alamat]', 'Alamat Ibu', ['class'=>'control-label']) !!}                                        
                    {!! Form::textarea('ibu[alamat]', !empty($data->ibu) ? $data->ibu->alamat : null, ['placeholder'=>'Alamat...', 'class'=>$errors->has('ibu.alamat') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('ibu.alamat', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>  
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="section-title">&bull; Biodata Wali</div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            {!! Form::hidden('wali[jenis]', 'WALI', null) !!}
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('wali[nama]', 'Nama Wali', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('wali[nama]', !empty($data->wali) ? $data->wali->nama : null, ['placeholder'=>'Nama Wali...', 'class'=>$errors->has('wali.nama') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('wali.nama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('wali[tempat_lahir]', 'Tempat Lahir', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('wali[tempat_lahir]', !empty($data->wali) ? $data->wali->tempat_lahir : null, ['placeholder'=>'Tempat lahir wali...', 'class'=>$errors->has('wali.tempat_lahir') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('wali.tempat_lahir', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('wali[tanggal_lahir]', 'Tanggal Lahir', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('wali[tanggal_lahir]', !empty($data->wali) ? $data->wali->tanggal_lahir : null, ['placeholder'=>'dd-mm-yyyy', 'autocomplete'=>'off', 'class'=>$errors->has('wali.tanggal_lahir') ? 'form-control tanggal is-invalid' : 'form-control tanggal']) !!}
                    {!! $errors->first('wali.tanggal_lahir', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('wali[agama]', 'Agama', ['class'=>'control-label']) !!}
                    {!! Form::select('wali[agama]', [''=>'', 'ISLAM'=>'ISLAM', 'KRISTEN'=>'KRISTEN', 'KATOLIK'=>'KATOLIK', 'HINDU'=>'HINDU', 'BUDHA'=>'BUDHA', 'LAINYA'=>'LAINYA'], null, ['class'=>$errors->has('ibu.agama') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('wali.agama', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('wali[pendidikan_id]', 'Pendidikan', ['class'=>'control-label']) !!} 
                    {!! Form::select('wali[pendidikan_id]', [''=>'']+$pendidikan, !empty($data->wali) ? $data->wali->pendidikan_id : null, ['class'=>$errors->has('wali.pendidikan_id') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('wali.pendidikan_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            {!! Form::hidden('ibu[jenis]', 'IBU', null) !!}            
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('wali[nik]', 'NIK Wali', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('wali[nik]', !empty($data->wali) ? $data->wali->nik : null, ['placeholder'=>'Nomor Induk Kependudukan...', 'class'=>$errors->has('wali.nik') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('wali.nik', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('wali[telp]', 'Telp. Wali', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('wali[telp]', !empty($data->wali) ? $data->wali->telp : null, ['placeholder'=>'Nomor telepon...', 'class'=>$errors->has('wali.telp') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('wali.telp', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('wali[pekerjaan]', 'Pekerjaan', ['class'=>'control-label']) !!} 
                    {!! Form::select('wali[pekerjaan]', [''=>'', 'TIDAK BEKERJA'=>'TIDAK BEKERJA', 'SWASTA'=>'SWASTA', 'WIRASWASTA'=>'WIRASWASTA', 'BURUH'=>'BURUH', 'PETANI'=>'PETANI', 'PNS'=>'PNS', 'POLRI'=>'POLRI', 'TNI'=>'TNI', 'PENSIUNAN PNS/POLRI/TNI'=>'PENSIUNAN PNS/POLRI/TNI', 'SUDAH MENINGGAL'=>'SUDAH MENINGGAL', 'LAINNYA'=>'LAINNYA'], !empty($data->wali) ? $data->wali->pekerjaan : null, ['class'=>$errors->has('wali.pekerjaan') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('wali.pekerjaan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('wali[penghasilan]', 'Penghasilan', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('wali[penghasilan]', !empty($data->wali) ? $data->wali->penghasilan : null, ['placeholder'=>'Penghasilan...', 'class'=>$errors->has('wali.penghasilan') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('wali.penghasilan', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('wali[alamat]', 'Alamat Wali', ['class'=>'control-label']) !!}                                        
                    {!! Form::textarea('wali[alamat]', !empty($data->wali) ? $data->wali->alamat : null, ['placeholder'=>'Alamat...', 'class'=>$errors->has('wali.alamat') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('wali.alamat', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>  
        </div>
    </div>
</div>

