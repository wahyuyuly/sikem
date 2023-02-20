@extends('backend.layouts.app')

@section('content')
    <div class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4><b>Legalisir dokumen {{ $data->jenis }}</b></h4>                                
                            <div class="card-header-action">
                                @php
                                    $status = 'light';
                                    if($data->status == 'PENDING') {
                                        $status = 'warning';
                                    } elseif ($data->status == 'DI TOLAK') {
                                        $status = 'danger';
                                    } elseif ($data->status == 'PROSES') {
                                        $status = 'primary';
                                    } elseif ($data->status == 'DAPAT DIAMBIL') {
                                        $status = 'info';
                                    } elseif ($data->status == 'SELESAI') {
                                        $status = 'success';
                                    }
                                @endphp
                                @if(Auth::user()->hasRole('mahasiswa'))
                                    <a href="#" class="btn btn-{{$status}}">{{$data->status}}</a>
                                @else
                                    {!! Form::open([route('legalisir.update', $data->id), 'id'=>'update', 'method'=>'patch']) !!}
                                        {!! Form::hidden('status', null, ['id'=>'status']) !!}
                                        {!! Form::hidden('alasan_tolak', null, ['id'=>'alasan_tolak']) !!}
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="btn btn-{{$status}} dropdown-toggle">{{$data->status}}</a>
                                        <div class="dropdown-menu">
                                            <a id="DI TOLAK" href="#" class="update dropdown-item has-icon text-danger"><i class="far fa-times-circle"></i> TOLAK</a>
                                            <a id="PROSES" href="#" class="update dropdown-item has-icon text-dark"><i class="fas fa-circle-notch"></i> PROSES</a>
                                            <a id="DAPAT DIAMBIL" href="#" class="update dropdown-item has-icon text-info"><i class="far fa-calendar-check"></i> DAPAT DIAMBIL</a>
                                            <a id="SELESAI" href="#" class="update dropdown-item has-icon text-success"><i class="far fa-check-circle"></i> SELESAI</a>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="media">
                                        @if (!empty($data->mahasiswa->account->photo))
                                            <a href="#" class="table-img m-r-15">
                                                <img alt="image" src="{{ asset('storage/photos/'.$data->mahasiswa->account->photo) }}" class="rounded-circle" width="55" height="55" data-toggle="tooltip" title="" data-original-title="Sachin Pandit">
                                            </a>
                                        @else
                                            <a href="#" class="table-img m-r-15">
                                                <img alt="image" src="{{ asset('assets/img/foto-m.png') }}" class="rounded-circle" width="55" data-toggle="tooltip" title="" data-original-title="Sachin Pandit">
                                            </a>
                                        @endif                                            
            
                                        <div class="media-body">
                                            <span class="date pull-right">{{ $data->created_at }}</span>
                                            <h6>{{ $data->mahasiswa->nama }}</h6>
                                            <small class="text-muted">{{ $data->mahasiswa->prodi->name ?? '-' }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">                                    
                                    <div class="view-mail p-t-20">                                        
                                        <p>{{ $data->keterangan ?? '-' }}</p>                                        
                                    </div>
                                    
                                    <div class="attachment-mail">
                                        <p>
                                            <span>
                                                <i class="fa fa-paperclip"></i>
                                                @if ($data->file)
                                                    <a href="{{ route('download.index', $data->file) }}" target="_blank">Unduh Dokumen Pendukung</a>
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </p>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="text-danger">
                                                *Mohon untuk meng-upload scan dokumen yang berkaitan dengan permohonan.
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('legalisir.print', $data->id) }}" target="_blank" class="btn btn-md btn-icon icon-left btn-primary"><i class="fas fa-print"></i> Cetak Bukti Pengambilan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Upload Dokumen Pendukung</h4>
                        </div>                        
                        {!! Form::open(['url' => route('legalisir.upload', $data->id), 'files'=>true, 'method'=>'patch']) !!}
                        <div class="card-body">
                            @alert
                            @endalert
                            <div class="form-group">
                                {!! Form::file('file', ['class'=>$errors->has('file') ? 'form-control is-invalid' : 'form-control']) !!}
                                <i style="font-size:8pt;">*Tipe berkas PDF dan ukuran maksimal 3MB</i>
                                {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-warning btn-md btn-icon icon-left" type="submit"><i class="fas fa-file-upload"></i> Upload</button>
                        </div>                               
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.update').on('click', function() {
            $('#status').val($(this).attr('id'));
            if($(this).attr('id') == 'DI TOLAK') {

            }
            swal({
                title: 'Anda Yakin?',
                text: "Status permohonan akan diubah.",
                icon: 'warning',
                buttons: {
                    cancel: "Batalkan",
                    confirm: "Tetap Ubah",
                },
                // content: {
                //     element: "input",
                //     attributes: {
                //         placeholder: "Alasan permohonan ditolak",
                //         type: "text",
                //     },              
                // },
                dangerMode: true,
            }).then((value) => {
                //alert(value);
                if(value) {
                   $('#update').submit();
                }
            });
        });
    </script>
@endsection