<div class="row">
    <div class="col-md-6">
        <div class="row">            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}                                        
                    {!! Form::email('email', null, ['placeholder'=>'Email...', 'class'=>$errors->has('email') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>            
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('username', 'Username', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('username', null, ['readonly', 'placeholder'=>'Username...', 'class'=>$errors->has('username') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('username', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('password', 'Password', ['class'=>'control-label']) !!}                                        
                    {!! Form::password('password', ['placeholder'=>'Password...', 'class'=>$errors->has('password') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('re-password', 'Ulangi Password', ['class'=>'control-label']) !!}                                        
                    {!! Form::password('re-password', ['placeholder'=>'Ulangi password...', 'class'=>$errors->has('re-password') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('re-password', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('photo', 'Foto', ['class'=>'control-label']) !!}
                    <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Pilih Foto</label>
                            <input type="file" name="photo" id="image-upload" "class"="{{$errors->has('photo') ? 'form-control is-invalid' : 'form-control'}}"/>
                        </div>
                    </div>
                    {!! $errors->first('photo', '<div class="invalid-feedback">:message</div>') !!}
                </div>                            
            </div>
        </div>
    </div>
</div>

