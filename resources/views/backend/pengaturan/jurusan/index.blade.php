@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Master Jurusan</h4>                            
                        </div>
                        <div class="card-body"> 
                            <div class="mb-4">
                                <a href="{{ route('master-jurusan.create') }}"><button class="btn btn-md btn-warning btn-icon icon-left"><i class="fas fa-plus"></i> Tambah Jurusan</button></a>
                            </div>                       
                             
                            @alert
                            @endalert

                            <div class="table-responsive">
                                <form id="check-data">
                                <table class="table table-striped" id="dataList">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Jurusan</th>
                                            <th>Deskripsi</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>
                                </table>
                                </form>
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
    <script>
        "use strict";

        var dataList = $('#dataList').DataTable({
            processing: true,
            serverSide: true,
            //order: [ 0, 'asc' ],
            responsive: true,
            ajax: {
                url: '{{ route("master-jurusan.index") }}',                
            },
            language: {
                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false},       
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},        
                {data: 'action', searchable: false, orderable: false, width: '20%'},
            ],
        });

        $.fn.dataTable.ext.errMode = 'none';
    </script>
    @delete
        {{ route('master-jurusan.destroy', ':id') }}
    @enddelete
@endsection