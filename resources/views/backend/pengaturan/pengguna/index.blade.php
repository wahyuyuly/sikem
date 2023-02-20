@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
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
                            <h4>Daftar Pengguna Aplikasi</h4>                            
                        </div>
                        <div class="card-body"> 
                            <div class="mb-4">
                                <a href="{{ route('pengguna.create') }}"><button class="btn btn-md btn-success btn-icon icon-left"><i class="fas fa-user-plus"></i> Tambah Pengguna</button></a>
                            </div>
                            {!! Form::open() !!}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">                                        
                                            {!! Form::label('role', 'Hak Akses', ['class'=>'control-label']) !!} 
                                            {!! Form::select('role', []+$roles, null, ['multiple'=>'multiple', 'class'=>$errors->has('role') ? 'multi-select form-control is-invalid' : 'multi-select form-control']) !!}
                                            {!! $errors->first('role', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">                                        
                                            {!! Form::label('status', 'Status Pengguna', ['class'=>'control-label']) !!} 
                                            {!! Form::select('status', ['active'=>'Aktif', 'non-active'=>'Tidak Aktif'], null, ['multiple'=>'multiple', 'class'=>$errors->has('status') ? 'multi-select form-control is-invalid' : 'multi-select form-control']) !!}
                                            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
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
                                            <th>Nama Pengguna</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Status</th>
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
    <script src="{{ asset('assets/backend/vendor/select2/dist/js/select2.full.min.js') }}"></script>
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
                url: '{{ route("pengguna.index") }}',
                data: function (d) {
                    d.role = $('select[name=role]').val();
                    d.status = $('select[name=status]').val();
                }
            },
            language: {
                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false},
                //{data: 'photo', name: 'photo', searchable: false, orderable: false},              
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'email', searchable: false, orderable: false},
                {data: 'status', searchable: false, orderable: false},        
                {data: 'action', searchable: false, orderable: false},
            ],
        });

        $.fn.dataTable.ext.errMode = 'none';    
    </script>
    @delete
        {{ route('pengguna.destroy', ':id') }}
    @enddelete
@endsection