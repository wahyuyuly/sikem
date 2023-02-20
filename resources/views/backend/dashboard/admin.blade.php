@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
    
    <style>
        .selection .select2-selection {
            border-color: '#dc3545' !important;
        }
        .select2-container{ width: 100% !important; }

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
        @role(['super-admin', 'admin-jurusan'])
        <div class="row ">
            <div class="col-xl-4 col-md-3 col-lg-6">
                <a href="{{ route('request-user.index') }}">                    
                    <div class="card l-bg-orange-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-id-card"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Request Pengguna</h4>                            
                                <p class="mb-0 text-sm">
                                    <h5>{{ $data['req_user'] ?? '-' }}</h5>
                                    <span class="text-nowrap">Belum diaktifkan</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-3 col-lg-6">
                <a href="{{ route('mahasiswa.index') }}">
                    <div class="card l-bg-cyan-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-id-card-alt"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Mahasiswa Aktif</h4>
                                <p class="mb-0 text-sm">
                                    <h5>{{ $data['mahasiswa'] ?? '-' }}</h5>
                                    <span class="text-nowrap">Terdaftar</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-md-3 col-lg-6">
                <a href="{{ route('alumni.index') }}">
                    <div class="card l-bg-purple-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-user-graduate"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Alumni</h4>
                                <p class="mb-0 text-sm">
                                    <h5>{{ $data['alumni'] ?? '-' }}</h5>
                                    <span class="text-nowrap">Terdaftar</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                    <h4>Keadaan Mahasiswa</h4>
                </div>
                <div class="card-body">
                    {!! Form::open() !!}
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">                                        
                                {!! Form::label('filterStatus', 'Status Mahasiswa', ['class'=>'control-label']) !!} 
                                {!! Form::select('filterStatus', ['AKTIF'=>'Mahasiswa Aktif', 'LULUS'=>'Alumni'], null, ['multiple'=>'multiple', 'class'=>'multi-select form-control']) !!}
                                {!! $errors->first('filterStatus', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('filterChart', 'Berdasarkan :', ['class' => 'control-label text-semibold text-right']) !!}
                                {!! Form::select('filterChart', ['tahun'=>'Tahun Masuk', 'prodi'=>'Program Studi'], null, ['class'=>'form-control input-xs']) !!}
                                {!! $errors->first('filterChart', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                    <div class="recent-report__chart">
                        <div id="chartDashboard"></div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        @endrole
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script>
        var kondisi, status, filter;
        var $multi = $('#filterStatus');
        // $("#filterChart").on('select2:select', function (e) { 
        //     var data = e.params.data;
        //     getChart('all', data.id);
        // });

        function getChart(status, filter) {
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ route('homeChart') }}",
                type:'post',
                data: {
                    _token: token,
                    status: status,
                    filter: filter
                },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        kondisi.series[0].setData(data);
                    }
                }
            });
        }

        $(document).ready(function() {
            $("#filterStatus, #filterChart").on('change', function() {
                status = $('#filterStatus').multipleSelect('getSelects');
                filter = $('#filterChart').val();
                getChart(status, filter);
            });

            $multi.multipleSelect({
                checkAll: true,
                placeholder: 'Pilih'
            });
            $multi.multipleSelect('checkAll');

            $("#filterChart").select2({
                minimumResultsForSearch: -1
            });

            kondisi = Highcharts.chart('chartDashboard', {
                exporting: { 
                    enabled: false 
                },
                credits: {
                    enabled: false
                },
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                    events: {
                        load: getChart('AKTIF,LULUS', 'tahun')
                    }
                },
                title: {
                    text: null,
                    style: {
                        display: 'none'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:.f}</b>'
                },
                plotOptions: {
                    pie: {
                        animation:{
                            duration: 2000
                        },
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.y:.f}'
                        },
                    }
                },
                series: [{
                    name: 'Jumlah',
                    colorByPoint: true,
                    data: []
                }]
            });
        });
    </script>
@endsection