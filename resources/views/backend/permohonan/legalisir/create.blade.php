@extends('backend.layouts.app')

@section('css')
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
                            <h4>Permohonan Legalisir Dokumen</h4>                            
                        </div>
                        {!! Form::open(['route'=>'legalisir.store', 'files'=>'true']) !!}
                        <div class="card-body">
                            @include('backend.permohonan.legalisir._form')                            
                        </div>
                        <div class="card-footer">                            
                            <a href="{{ route('home') }}"><button type="button" class="btn btn-danger btn-icon icon-left"><i class="fas fa-undo-alt"></i> Batal</button></a>
                            <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/selectric/public/jquery.selectric.min.js') }}"></script>
    <script>
        "use strict";
        $(document).ready(function() {    
            $(".choice").select2({
                minimumResultsForSearch: -1,
                placeholder: 'Pilih...',
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

            $('#mahasiswa_id').select2({
                placeholder: 'Pilih...',
                ajax: {
                    url: '{{ route('mahasiswa.list') }}',
                    data: function (params) {
                        var query = {
                            search: params.term,
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
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });
            $('#mahasiswa_id').on('select2:select', function (e) {
                var data = e.params.data;
                $("#npm").val(data.nim);
            });
        });
    </script>
@endsection