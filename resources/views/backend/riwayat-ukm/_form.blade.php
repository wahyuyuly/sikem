{!! Form::hidden('id', $id) !!}
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('ukm_id', 'Unit Kegiatan Mahasiswa', ['class'=>'control-label']) !!}                                    
                    {!! Form::select('ukm_id', [''=>'']+$ukm, null, ['class'=>$errors->has('ukm_id') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('ukm_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('file', 'Scan Surat Keputusan', ['class'=>'control-label']) !!}                                    
                    {!! Form::file('file', ['class'=>$errors->has('file') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>