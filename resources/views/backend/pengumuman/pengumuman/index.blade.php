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
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="navigasi nav-link active" id="all" href="#">Semua</a>
                                </li>
                                <li class="nav-item">
                                    <a class="navigasi nav-link" id="publish" href="#">Publish</a>
                                </li>
                                <li class="nav-item">
                                    <a class="navigasi nav-link" id="unpublish" href="#">Tidak Publish</a>
                                </li>
                            </ul>
                            <form>
                                <input type="hidden" id="navigasi" value="all">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Pengumuman</h4>                            
                        </div>
                        <div class="card-body"> 
                            <div class="mb-4">
                                <a href="{{ route('pengumuman.create') }}"><button class="btn btn-md btn-warning btn-icon icon-left"><i class="fas fa-plus"></i> Buat Pengumuman</button></a>
                            </div>                       
                             
                            @alert
                            @endalert

                            <div class="table-responsive">
                                <form id="check-data">
                                <table class="table table-striped" id="dataList">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Penulis</th>
                                            <th>Dilihat</th>
                                            <th>Diperbarui</th>
                                            <th>Status</th>
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
                                                <button id="deldata" class="btn btn-sm btn-danger btn-icon icon-left" type="button"><i class="fas fa-trash"></i> Hapus Item Terpilih</button>
                                            </td>
                                        </tr>
                                    </tfoot>
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

        $('.navigasi').click(function(e) {
            e.preventDefault();
            $('#navigasi').val($(this).attr('id'));
            $('.navigasi').removeClass('active');
            $(this).addClass('active');
            dataList.draw();
        })

        var dataList = $('#dataList').DataTable({
            processing: true,
            serverSide: true,
            //order: [ 0, 'asc' ],
            responsive: true,
            ajax: {
                url: '{{ route("pengumuman.index") }}',
                data: function (d) {
                    d.navigasi = $('#navigasi').val();
                }             
            },
            language: {
                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
            },
            columns: [
                //{data: 'DT_RowIndex', searchable: false, orderable: false},   
                {data: 'checkbox', searchable: false, orderable: false, width: '5%'},           
                {data: 'title', name: 'title'},
                {data: 'category.name', name: 'category'},
                {data: 'author', name: 'author'},
                {data: 'hit', name: 'hit'},
                {data: 'date_id', name: 'update'},
                {data: 'status', searchable: false, orderable: false}
            ],
        });

        $.fn.dataTable.ext.errMode = 'none';
    </script>
    @delete
        {{ route('pengumuman.destroy', ':id') }}
    @enddelete
@endsection