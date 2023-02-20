@php
    $cat_as = ['Kartu Indonesia Sehat (KIS)', 'BPJS'];
    $cat_kartu = ['Kartu Indonesia Pintar (KIP)', 'Kartu Keluarga Sejahtera (KSS)', 'Tidak Memiliki'];
@endphp
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('jenis_asuransi', 'Asuransi/Jaminan Kesehatan', ['class' => 'control-label']) !!}
                    {!! Form::select('jenis_asuransi', [''=>'', 'Kartu Indonesia Sehat (KIS)'=>'Kartu Indonesia Sehat (KIS)', 'BPJS'=>'BPJS', 'lain'=>'Lainnya'], !empty($data->asuransi) ? in_array($data->asuransi->nama, $cat_as) ? $data->asuransi->nama : 'lain' : null, ['class'=>$errors->has('jenis_asuransi') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('jenis_asuransi', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('asuransi', 'Nama Asuransi/Jaminan Kesehatan', ['class' => 'control-label']) !!}
                    {!! Form::text('asuransi', !empty($data->asuransi) ? $data->asuransi->nama : null, [!empty($data->asuransi) && in_array($data->asuransi->nama, $cat_as) ? 'readonly' : '', 'placeholder' => 'Nama...', 'class'=>$errors->has('asuransi') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('asuransi', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('file_asuransi', 'Scan Kartu/Dokumen', ['class'=>'control-label']) !!}
                    <div class="input-group mb-3">
                        {!! Form::file('file_asuransi', ['class'=>$errors->has('file_asuransi') ? 'form-control is-invalid' : 'form-control']) !!}
                        {!! $errors->first('file_asuransi', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('jenis_kartu', 'Kartu Dari Pemerintah', ['class' => 'control-label']) !!}
                    {!! Form::select('jenis_kartu', [''=>'', 'Kartu Indonesia Pintar (KIP)'=>'Kartu Indonesia Pintar (KIP)', 'Kartu Keluarga Sejahtera (KSS)'=>'Kartu Keluarga Sejahtera (KSS)', 'Tidak Memiliki'=>'Tidak Memiliki', 'lain'=>'Lainnya'], !empty($data->kartu) ? in_array($data->kartu->nama, $cat_kartu) ? $data->kartu->nama : 'lain' : null, ['class'=>$errors->has('jenis_kartu') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('jenis_kartu', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('kartu', 'Nama Kartu', ['class' => 'control-label']) !!}
                    {!! Form::text('kartu', !empty($data->kartu) ? $data->kartu->nama : null, [!empty($data->kartu) && in_array($data->kartu->nama, $cat_kartu) ? 'readonly' : '', 'placeholder' => 'Nama...', 'class'=>$errors->has('kartu') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('kartu', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('file_kartu', 'Scan Kartu/Dokumen', ['class'=>'control-label']) !!}
                    <div class="input-group mb-3">
                        {!! Form::file('file_kartu', ['class'=>$errors->has('file_kartu') ? 'form-control is-invalid' : 'form-control']) !!}
                        {!! $errors->first('file_kartu', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>