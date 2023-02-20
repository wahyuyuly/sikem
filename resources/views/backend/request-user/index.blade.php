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
                            <h4>Daftar Request Persetujuan Pengguna Baru</h4>                            
                        </div>
                        <div class="card-body">
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
                                            <th>Status Pengguna</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>                                    
                                    <tfoot>
                                        <tr>
                                            <td>
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <button id="update-all" class="btn btn-sm btn-success btn-icon icon-left" type="button"><i class="far fa-check-circle"></i> Aktifkan Yang Ditandai</button>
                                            </td>
                                        </tr>
                                    </tfoot>
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

        $("[data-checkboxes]").each(function () {
            var me = $(this),
            group = me.data('checkboxes'),
            role = me.data('checkbox-role');
        
            me.change(function () {
            var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
                checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
                dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
                total = all.length,
                checked_length = checked.length;
        
            if (role == 'dad') {
                if (me.is(':checked')) {
                all.prop('checked', true);
                } else {
                all.prop('checked', false);
                }
            } else {
                if (checked_length >= total) {
                dad.prop('checked', true);
                } else {
                dad.prop('checked', false);
                }
            }
            });
        });

        $('#update-all').on('click', function() {
            var id = [];
            $.each($("input[name='check[]']:checked"), function(){
                id.push($(this).val());
            });
            swal({
                title: 'Anda Yakin?',
                text: "Pengguna yang ditandai akan diaktifkan!",
                icon: 'warning',
                buttons: {
                    cancel: "Batalkan",
                    confirm: "Aktifkan",
                },
                dangerMode: true,
            }).then((value) => {
                if(value) {
                    $.ajax({
                        url: "{{ route('request-user.batchupdate') }}",
                        type: "POST",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'id': id
                        },
                        success: function(data) {
                            dataList.ajax.reload();
                            swal({
                                title: data.title,
                                text: data.message,
                                icon: data.type,
                            })
                        },
                        error: function(data) {
                            swal({
                                title: 'Oops...',
                                text: 'Galat \n'+data.responseJSON.message,
                                icon: 'error'
                            })
                        }
                    });
                }
            });
        });

        var dataList = $('#dataList').DataTable({
            processing: true,
            serverSide: true,
            //order: [ 0, 'asc' ],
            responsive: true,
            ajax: {
                url: '{{ route("request-user.index") }}',                
            },
            language: {
                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
            },
            columns: [
                //{data: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'checkbox', searchable: false, orderable: false, width: '5%'},           
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'email', searchable: false, orderable: false},
                {data: 'status', searchable: false, orderable: false},        
                {data: 'action', searchable: false, orderable: false},
            ],
        });

        $('#dataList tbody').on('click', '.update', function () {
            var id = $(this).attr('id');
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var url = '{{ route('request-user.update', ":id") }}';
                url = url.replace(':id', id);
            swal({
                title: 'Anda Yakin?',
                text: "Pengguna akan diaktifkan!",
                icon: 'warning',
                buttons: {
                    cancel: "Batalkan",
                    confirm: "Aktifkan",
                },
                dangerMode: true,
            }).then((value) => {
                if(value) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_method': 'PATCH',
                            '_token': csrf_token
                        },
                        success: function(data) {
                            dataList.ajax.reload();
                            swal({
                                title: data.title,
                                text: data.message,
                                icon: data.type,
                            })
                        },
                        error: function(data) {
                            swal({
                                title: 'Oops...',
                                text: 'Galat \n'+data.responseJSON.message,
                                icon: 'error'
                            })
                        }
                    });
                }
            });
        })

        $.fn.dataTable.ext.errMode = 'none';          
    </script>
    @delete
        {{ route('request-user.destroy', ':id') }}
    @enddelete
@endsection