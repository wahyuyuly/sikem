@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/selectric/public/selectric.css') }}">
    <style>
        .select2-result-repository {
            padding-top: 4px;
            padding-bottom: 3px;
        }
        .select2-result-repository__avatar {
            width: 60px;
            margin-right: 10px;
            float: left;
        }
        .select2-result-repository__avatar img {
            border-radius: 2px;
            width: 100%;
            height: 60px;
        }
        .select2-result-repository__meta {
            margin-left: 70px;
        }
        .select2-result-repository__title {
            color: black;
            line-height: 1.1;
            font-weight: bold;
            margin-bottom: 4px;
            -ms-word-wrap: break-word;
        }
        .select2-result-repository__forks {
            margin-right: 1em;
        }
        .select2-result-repository__stargazers {
            margin-right: 1em;
        }
        .select2-result-repository__forks {
            color: rgb(170, 170, 170);
            font-size: 11px;
            display: inline-block;
        }
        .select2-result-repository__stargazers {
            color: rgb(170, 170, 170);
            font-size: 11px;
            display: inline-block;
        }
        .select2-result-repository__watchers {
            color: rgb(170, 170, 170);
            font-size: 11px;
            display: inline-block;
        }
        .select2-result-repository__description {
            color: rgb(119, 119, 119);
            font-size: 13px;
            margin-top: 4px;
        }
        .select2-results__option--highlighted .select2-result-repository__title {
            color: white;
        }
        .select2-results__option--highlighted .select2-result-repository__forks {
            color: rgb(198, 220, 239);
        }
        .select2-results__option--highlighted .select2-result-repository__stargazers {
            color: rgb(198, 220, 239);
        }
        .select2-results__option--highlighted .select2-result-repository__description {
            color: rgb(198, 220, 239);
        }
        .select2-results__option--highlighted .select2-result-repository__watchers {
            color: rgb(198, 220, 239);
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
                        <h4>Manajamen Dokumen</h4>                            
                    </div>
                    <div class="card-body">
                        @alert
                        @endalert
                        @role(['super-admin', 'admin'])
                        {!! Form::open() !!}
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">                                        
                                        {!! Form::label('mahasiswa_id', 'Nama Mahasiswa', ['class'=>'control-label']) !!}
                                        {!! Form::select('mahasiswa_id', [''=>''], null, ['class'=>$errors->has('mahasiswa_id') ? 'form-control is-invalid' : 'form-control']) !!}
                                        {!! $errors->first('mahasiswa_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                        
                                        {!! Form::label('npm', 'NPM', ['class'=>'control-label']) !!}                                        
                                        {!! Form::text('npm', null, ['disabled','placeholder'=>'NPM Mahasiswa...', 'class'=>$errors->has('npm') ? 'form-control is-invalid' : 'form-control']) !!}
                                        {!! $errors->first('npm', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        @endrole
                        <a href="#" id="tambah-file" class="mb-3 btn btn-sm btn-outline-success btn-cion icon-left {{ Auth::user()->hasRole(['mahasiswa']) ? '' : 'disabled' }}"><i class="fas fa-file-upload"></i> Tambah File</a>                        

                        <div class="table-responsive">
                            <table class="table table-striped" id="dataList">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Berkas</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
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
    <script src="{{ asset('assets/backend/vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        "use strict";
        var mahasiswa_id = "{{ Auth::user()->hasRole(['mahasiswa']) ? Auth::user()->mahasiswa->id : '' }}";
        var dataList = $('#dataList').DataTable({
            processing: true,
            serverSide: true,
            //order: [ 0, 'asc' ],
            responsive: true,
            ajax: {
                url: '{{ route("files.index") }}',
                data: function(d) {
                    d.data = mahasiswa_id
                }
            },
            language: {
                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false},        
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'file', searchable: false, orderable: false},        
                {data: 'action', searchable: false, orderable: false},
            ],
        });

        $.fn.dataTable.ext.errMode = 'none';
        
        $(document).ready(function() { 
            $('#mahasiswa_id').select2({
                placeholder: 'Pilih...',
                ajax: {
                    url: '{{ route('mahasiswa.list') }}',
                    data: function (params) {
                        var query = {
                            search: params.term
                        }
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.nama,
                                    id: item.id,
                                    nim: item.npm,
                                    photo: item.account.photo
                                }
                            })
                        };
                    },
                },
                escapeMarkup: function (markup) { return markup; },
                minimumInputLength: 2,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });
            $('#mahasiswa_id').on('select2:select', function (e) {
                var data = e.params.data;
                mahasiswa_id = data.id;
                $('#tambah-file').removeClass('disabled');
                $("#npm").val(data.nim);
                dataList.draw();
            });

            $('#tambah-file').on('click', function(e) {
                e.preventDefault();

                var ret = '{{ route("files.create", ":id") }}';
                    ret = ret.replace(':id', mahasiswa_id);

                window.location.replace(ret);
            });

            function formatRepo(repo) {
                if (repo.loading) return repo.text;
                var markup = "<div class = 'select2-result-repository clearfix'>";
                if (repo.photo) {
                    markup += "<div class='select2-result-repository__avatar'><img src='{{ url("/") }}/storage/photos/" + repo.photo + "' /></div>";
                } else {
                    markup += "<div class='select2-result-repository__avatar'><img src='{{ asset("assets/img/foto-m.png") }}' /></div>";
                }
                markup += "<div class = 'select2-result-repository__meta' >" +
                "<div class = 'select2-result-repository__title' > " + repo.text + " </div>";
                if (repo.nim) {
                    markup += " <div class = 'select2-result-repository__description' > " + repo.nim + "</div>";
                }
                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.text;
            }
        });
    </script>
    @delete
        {{ route('files.destroy', ':id') }}
    @enddelete
@endsection