{!! Form::hidden('id', $id) !!}
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">                                        
                    {!! Form::label('semester', 'Semester', ['class'=>'control-label']) !!}                                    
                    {!! Form::select('semester', [''=>'', '1'=>'I - Satu', '2'=>'II - Dua', '3'=>'III - Tiga', '4'=>'IV - Empat', '5'=>'V - Lima', '6'=>'VI - Enam', '7'=>'VII - Tujuh', '8'=>'VIII - Delapan', '9' => 'IX - Sembilan', '10'=>'X - Sepuluh', '11'=>'XI - Sebelas', '12'=>'XII - Dua Belas', '13'=>'XIII - Tiga Belas', '14'=>'XIV - Empat Belas'], null, ['class'=>$errors->has('semester') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('semester', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('jumlah_sks', 'Jumlah SKS', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('jumlah_sks', null, ['placeholder'=>'Jumlah SKS...', 'class'=>$errors->has('jumlah_sks') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('jumlah_sks', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>     
            <div class="col-md-4">
                <div class="form-group">                                        
                    {!! Form::label('ipk', 'Indeks Prestasi (IP)', ['class'=>'control-label']) !!}                                    
                    {!! Form::text('ipk', null, ['placeholder'=>'IP...', 'class'=>$errors->has('ipk') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('ipk', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('file', 'Scan KHS', ['class'=>'control-label']) !!}                                    
                    {!! Form::file('file', ['class'=>$errors->has('file') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>