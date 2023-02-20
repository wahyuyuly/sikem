<div class="row">
    <div class="col-md-4">
        <div class="form-group">                                        
            {!! Form::label('minat_ukm[]', 'UKM Yang Diminati', ['class'=>'control-label']) !!} 
            {!! Form::select('minat_ukm[]', []+$ukm, null, ['id'=>'minat_ukm','multiple'=>'multiple', 'class'=>$errors->has('minat_ukm.*') ? 'multi-check form-control is-invalid' : 'multi-check form-control']) !!}
            {!! $errors->first('minat_ukm.*', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="d-block">Berminat Mengikuti Student Exchange Ke Luar Negeri?</label>
            <div class="form-check form-check-inline">
                {!! Form::radio('exchange', 'Berminat', !empty($data->minat) && $data->minat->exchange == 'Berminat' ? true : false, ['id'=>'exchange_yes', 'class'=>'form-check-input']) !!}
                {!! Form::label('exchange_yes', 'Ya', ['class'=>'form-check-label']) !!}
            </div>
            <div class="form-check form-check-inline">
                {!! Form::radio('exchange', 'Tidak Berminat', !empty($data->minat) && $data->minat->exchange == 'Tidak Berminat' ? true : false, ['id'=>'exchange_no', 'class'=>'form-check-input']) !!}
                {!! Form::label('exchange_no', 'Tidak', ['class'=>'form-check-label']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="d-block">Berminat Bekerja di Luar Negeri?</label>
            <div class="form-check form-check-inline">
                {!! Form::radio('overseas_check', 'yes', !empty($data->minat) && $data->minat->overseas != null ? true : false, ['id'=>'overseas_yes', 'class'=>'form-check-input']) !!}
                {!! Form::label('overseas_yes', 'Ya', ['class'=>'form-check-label']) !!}
            </div>
            <div class="form-check form-check-inline">
                {!! Form::radio('overseas_check', 'no', !empty($data->minat) && $data->minat->overseas == null ? true : false, ['id'=>'overseas_no', 'class'=>'form-check-input']) !!}
                {!! Form::label('overseas_no', 'Tidak', ['class'=>'form-check-label']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">                                        
            {!! Form::label('overseas', 'Negara Tujuan', ['class'=>'control-label']) !!}                                        
            {!! Form::text('overseas', !empty($data->minat) && $data->minat->overseas != null ? $data->minat->overseas : false, [!empty($data->minat) && $data->minat->overseas != null ? '' : 'disabled' , 'placeholder'=>'Negara...', 'class'=>$errors->has('overseas') ? 'form-control is-invalid' : 'form-control']) !!}
            {!! $errors->first('overseas', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="field-bahasa">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">                                        
                        {!! Form::label('bahasa[]', 'Kemampuan Bahasa Asing', ['class'=>'control-label']) !!}                                        
                        {!! Form::text('bahasa[]', '', ['placeholder'=>'Bahasa...', 'class'=>$errors->has('bahasa.*') ? 'form-control is-invalid' : 'form-control']) !!}
                        {!! $errors->first('bahasa.*', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('file_bahasa[]', 'Scan sertifikat', ['class'=>'control-label']) !!}
                        <div class="input-group mb-3">
                            {!! Form::file('file_bahasa[]', ['class'=>$errors->has('file_bahasa.*') ? 'form-control is-invalid' : 'form-control']) !!}
                            {!! $errors->first('file_bahasa.*', '<div class="invalid-feedback">:message</div>') !!}
                            <div class="input-group-append">
                                <button class="add-bahasa btn btn-primary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>