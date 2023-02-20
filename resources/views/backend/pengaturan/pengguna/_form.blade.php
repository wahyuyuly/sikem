@php
    if(isset($data)) {
        $disable = false;
        if($data->hasRole('mahasiswa')) {
            $disable = true;
        }
    }
@endphp
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('name', 'Nama Pengguna', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('name', null, ['readonly'=> $disable ? true : false, 'placeholder'=>'Nama pengguna...', 'class'=>$errors->has('name') ? 'form-control is-invalid' : 'form-control', Auth::user()->hasRole(['mahasiswa']) ? 'readonly' : '']) !!}
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">                                        
                    {!! Form::label('username', 'Username', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('username', null, ['readonly'=> $disable ? true : false, 'placeholder'=>'Username...', 'class'=>$errors->has('username') ? 'form-control is-invalid' : 'form-control', Auth::user()->hasRole(['mahasiswa']) ? 'readonly' : '']) !!}
                    {!! $errors->first('username', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}                                        
                    {!! Form::email('email', null, ['placeholder'=>'Email...', 'class'=>$errors->has('email') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('password', 'Password', ['class'=>'control-label']) !!}                                        
                    {!! Form::password('password', ['class'=>$errors->has('password') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('re-password', 'Ulangi Password', ['class'=>'control-label']) !!}                                        
                    {!! Form::password('re-password', ['class'=>$errors->has('re-password') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('re-password', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            @role('super-admin')                                 
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('role_access', 'Hak Akses', ['class'=>'control-label']) !!} 
                    {!! Form::select('role_access', $role, !empty($data->role) ? $data->role->id : null, ['class'=>$errors->has('role_access') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('role_access', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('status', 'Status', ['class'=>'control-label']) !!} 
                    {!! Form::select('status', ['active'=>'AKTIF', 'non-active'=>'TIDAK AKTIF'], null, ['class'=>$errors->has('status') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                    {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            @endrole
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('photo', 'Foto', ['class'=>'control-label']) !!}
                    <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Pilih Foto</label>
                            <input type="file" name="photo" id="image-upload" class="{{$errors->has('photo') ? 'form-control is-invalid' : 'form-control'}}"/>
                        </div>
                    </div>
                    {!! $errors->first('photo', '<div class="invalid-feedback">:message</div>') !!}
                </div>                            
            </div>
        </div>
    </div>
</div>