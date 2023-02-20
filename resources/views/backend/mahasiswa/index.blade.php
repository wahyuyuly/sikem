@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
    
    <style>
        .ms-choice {
            border: 0px solid #aaa;
        }

        .ms-choice>span {
            position:inherit;
        }
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Mahasiswa</h4>                            
                        </div>
                        <div class="card-body"> 
                            {!! Form::open() !!}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">                                        
                                            {!! Form::label('prodi_id', 'Program Studi', ['class'=>'control-label']) !!} 
                                            {!! Form::select('prodi_id', []+$prodi, null, ['multiple'=>'multiple', 'class'=>$errors->has('prodi_id') ? 'multi-select form-control is-invalid' : 'multi-select form-control']) !!}
                                            {!! $errors->first('prodi_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('tahun', 'Tahun Masuk', ['class'=>'control-label']) !!}
                                            <div class="input-group">
                                                {!! Form::text('tahun_start', null, ['placeholder'=>'Dari tahun', 'class'=>'form-control']) !!}
                                                {!! Form::text('tahun_end', null, ['placeholder'=>'Sampai tahun', 'class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">                                        
                                            {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'control-label']) !!} 
                                            {!! Form::select('jenis_kelamin', ['LAKI-LAKI'=>'LAKI-LAKI', 'PEREMPUAN'=>'PEREMPUAN'], null, ['multiple'=>'multiple', 'class'=>$errors->has('jenis_kelamin') ? 'multi-select form-control is-invalid' : 'multi-select form-control']) !!}
                                            {!! $errors->first('jenis_kelamin', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <button id="filter" class="btn btn-icon icon-left btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                             
                            @alert
                            @endalert

                            <div class="table-responsive">
                                <table class="table table-striped" id="dataList">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>NIM</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tahun Masuk</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script>
        "use strict";

        $('.multi-select').multipleSelect({
            filter: true,
            placeholder: 'Pilih'
        });

        $('#filter').on('click', function(e) {
            e.preventDefault();
            dataList.draw();
        })

        var dataList = $('#dataList').DataTable({
            processing: true,
            serverSide: true,
            //order: [ 0, 'asc' ],
            responsive: true,
            ajax: {
                url: '{{ route("mahasiswa.index") }}',
                data: function (d) {
                    d.prodi_id = $('select[name=prodi_id]').val();
                    d.tahun_start = $('input[name=tahun_start]').val();
                    d.tahun_end = $('input[name=tahun_end]').val();
                    d.jenis_kelamin = $('select[name=jenis_kelamin]').val();
                }
            },
            language: {
                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false},
                //{data: 'photo', name: 'photo', searchable: false, orderable: false},              
                {data: 'nama', name: 'nama'},
                {data: 'npm', name: 'npm'},
                {data: 'jenis_kelamin', searchable: false, orderable: false},
                {data: 'tahun_masuk', searchable: false, orderable: false},      
                {data: 'action', searchable: false, orderable: false},
            ],
        });

        $.fn.dataTable.ext.errMode = 'none';
    </script>
    @delete
        {{ route('mahasiswa.destroy', ':id') }}
    @enddelete
@endsection