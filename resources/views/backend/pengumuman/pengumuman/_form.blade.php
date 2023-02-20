<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">                                        
                    {!! Form::label('title', 'Judul Pengumuman', ['class'=>'control-label']) !!}                                        
                    {!! Form::text('title', null, ['placeholder'=>'Judul pengumuman...', 'class'=>$errors->has('title') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::textarea('content', null, ['id'=>'content']) !!}
                    {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('file', 'Lampiran', ['class'=>'control-label']) !!}
                    {!! Form::file('file', ['class'=>$errors->has('file') ? 'form-control is-invalid' : 'form-control']) !!}
                    {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-12">
            <div class="form-group">                                        
                {!! Form::label('category_id', 'Kategori', ['class'=>'control-label']) !!} 
                {!! Form::select('category_id', $kategori, null, ['class'=>$errors->has('category_id') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">                                        
                {!! Form::label('status', 'Status', ['class'=>'control-label']) !!} 
                {!! Form::select('status', ['publish'=>'PUBLISH', 'unpublish'=>'NOT PUBLISH', 'draft'=>'DRAFT'], null, ['class'=>$errors->has('status') ? 'form-control choice is-invalid' : 'form-control choice']) !!}
                {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('photo', 'Cover', ['class'=>'control-label']) !!}
                <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Pilih Foto</label>
                        <input type="file" name="image" id="image-upload" class="{{$errors->has('photo') ? 'form-control is-invalid' : 'form-control'}}"/>
                    </div>
                </div>
                {!! $errors->first('photo', '<div class="invalid-feedback">:message</div>') !!}
            </div>                            
        </div>
    </div>
</div>