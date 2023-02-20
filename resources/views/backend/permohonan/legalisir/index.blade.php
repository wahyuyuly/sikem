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
                            <h4>Daftar Permohonan Legalisir Dokumen</h4>                            
                        </div>
                        <div class="card-body">        
                             
                            @alert
                            @endalert

                            <div class="table-responsive">
                                <table class="table table-striped" id="dataList">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Unik</th>
                                            <th>Jenis Dokumen</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
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
    <script>
        "use strict";

        var dataList = $('#dataList').DataTable({
            processing: true,
            serverSide: true,
            //order: [ 0, 'asc' ],
            responsive: true,
            ajax: {
                url: '{{ route("legalisir.index") }}',                
            },
            language: {
                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false},   
                {data: 'nomor', name: 'kode'},           
                {data: 'jenis', name: 'jenis'},
                {data: 'keterangan', name: 'keterangan'},
                {data: 'status', searchable: false, orderable: false},
                {data: 'created_at', searchable: false, orderable: false},        
                {data: 'action', searchable: false, orderable: false},
            ],
        });

        $.fn.dataTable.ext.errMode = 'none';
    </script>
    @delete
        {{ route('legalisir.destroy', ':id') }}
    @enddelete
@endsection