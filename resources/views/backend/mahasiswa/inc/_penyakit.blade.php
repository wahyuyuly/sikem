@if (isset($data) && count($data->penyakit) > 0)
    <div class="row">
        <div class="col-md-8">
            <div class="field">
            @foreach ($data->penyakit as $i => $item)        
                <div class="row {{ $i == 0 ? '' : 'idForm-'.$i }}">
                    <div class="col-md-6">
                        <div class="form-group">                                        
                            {!! Form::label('penyakit[]', 'Nama Penyakit', ['class'=>'control-label']) !!}                                        
                            {!! Form::text('penyakit[]', $item->nama, ['placeholder'=>'Penyakit...', 'class'=>$errors->has('penyakit.*') ? 'form-control is-invalid' : 'form-control']) !!}
                            {!! $errors->first('penyakit.*', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('penyakit[tahun][]', 'Tahun', ['class'=>'control-label']) !!}
                            <div class="input-group mb-3">
                                {!! Form::text('tahun_sakit[]', $item->tahun, ['placeholder'=>'Tahun sakit...', 'class'=>$errors->has('tahun_sakit.*') ? 'form-control is-invalid' : 'form-control']) !!}
                                {!! $errors->first('tahun_sakit.*', '<div class="invalid-feedback">:message</div>') !!}
                                <div class="input-group-append">
                                    <button class="btn {{ $i == 0 ? 'btn-primary add-more' : 'btn-danger remove'}}" data-id="{{ $i == 0 ? '' : $i }}" type="button"><i class="fas {{ $i == 0 ? 'fa-plus' : 'fa-minus'}}"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-8">
            <div class="field">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">                                        
                            {!! Form::label('penyakit[]', 'Nama Penyakit', ['class'=>'control-label']) !!}                                        
                            {!! Form::text('penyakit[]', '', ['placeholder'=>'Penyakit...', 'class'=>$errors->has('penyakit.*') ? 'form-control is-invalid' : 'form-control']) !!}
                            {!! $errors->first('penyakit.*', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('tahun_sakit[]', 'Tahun', ['class'=>'control-label']) !!}
                            <div class="input-group mb-3">
                                {!! Form::text('tahun_sakit[]', null, ['placeholder'=>'Tahun sakit...', 'class'=>$errors->has('tahun_sakit.*') ? 'form-control is-invalid' : 'form-control']) !!}
                                {!! $errors->first('tahun_sakit.*', '<div class="invalid-feedback">:message</div>') !!}
                                <div class="input-group-append">
                                    <button class="add-more btn btn-primary" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif