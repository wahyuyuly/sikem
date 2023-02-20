@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
    
    <style>
        .ms-choice {
            border: 0px solid #aaa;
        }

        .ms-choice>span {
            position:inherit;
        }
    </style>
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
                            <h4>Data Capaian Semester</h4> 
                        </div>
                        <div class="card-body">
                            @alert
                            @endalert
                            @role(['super-admin', 'admin'])
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
                            <a href="#" id="tambah-data" class="mb-3 btn btn-sm btn-success btn-icon icon-left {{ Auth::user()->hasRole(['mahasiswa']) ? '' : 'disabled' }}" type="button"><i class="fas fa-plus"></i> Tambah Capaian</a>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dataList">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Tahun Masuk</th>
                                            <th>Aksi</th>
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

    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content detail-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Maulidaya Laila Izzati</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="detailTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Semester</th>
                                    <th>IPK</th>
                                    <th>Dokumen</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script>
        "use strict";
        var $select = $('.multi-select')
        $select.multipleSelect({
            filter: true,
            placeholder: 'Pilih'
        });
        $select.multipleSelect('checkAll');

        $('#filter').on('click', function(e) {
            e.preventDefault();
            dataList.draw();
        })

        var mahasiswa_id = '';
        
        var dataList = $('#dataList').DataTable({
            processing: true,
            serverSide: true,
            //order: [ 0, 'asc' ],
            responsive: true,
            ajax: {
                url: '{{ route("capaian-semester.index") }}',
                data: function(d) {
                    d.data = mahasiswa_id;
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
                {data: 'nama', name: 'nama'},
                {data: 'npm', name: 'npm'},
                {data: 'tahun_masuk', name: 'tahun_masuk'},
                {data: 'action', searchable: false, orderable: false, width: '20%'},
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
                $('#tambah-data').removeClass('disabled');
                $("#npm").val(data.nim);
                //dataList.draw();
            });

            $('#tambah-data').on('click', function(e) {
                e.preventDefault();

                var ret = '{{ route("capaian-semester.create", ":id") }}';
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

            $('body').on('click', '.detail-semester', function() {
                var id = $(this).data('id');
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route("capaian-semester.detail") }}', 
                    type: "POST",
                    data: {
                        '_token': csrf_token,
                        'id': id
                    },
                    success: function(data) {
                        $('.detail-content').html(data);
                        $('#detailTable').DataTable({
                            language: {
                                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
                            }
                        });
                        $('#detail').modal('show');
                    },
                    error : function() {
                        alert("Nothing Data");
                    }
                });
            });
        });
    </script>
    @delete
        {{ route('capaian-semester.destroy', ':id') }}
    @enddelete
@endsection