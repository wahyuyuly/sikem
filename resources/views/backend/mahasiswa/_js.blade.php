
    <script>
        "use strict";
        var $multi = $('#minat_ukm');

        $(document).ready(function() {
            $("#npm").change(function() {
                $("#username").val($(this).val());
            });

            $(".choice").select2({
                minimumResultsForSearch: -1,
                placeholder: 'Pilih...',
                allowClear: true
            });

            $(".choice-s").select2({
              minimumResultsForSearch: -1,
              placeholder: 'Pilih...'
            });

            $multi.multipleSelect({
                filter: true,
                placeholder: 'Pilih'
            });
            @if(!empty($data->minat) && $data->minat->minat_ukm != null)
                $multi.multipleSelect('setSelects', {!! json_encode(explode(',', $data->minat->minat_ukm)) !!});
            @endif

            var status = $('#status').val();
            if(status != "LULUS") {
              $('#tanggal_yudisium').prop("disabled", true);
            }

            $('#status').on('select2:select', function (e) {
              var data = e.params.data;
              $('#tanggal_yudisium').prop("disabled", true);
              if(data.id == "LULUS") {
                $('#tanggal_yudisium').prop("disabled", false);
              }
            });

            $('.tanggal').toArray().forEach(function(field){
                new Cleave(field, {
                    date: true,
                    delimiter: '-',
                    datePattern: ['d', 'm', 'Y']
                });
            });

            $.uploadPreview({
                input_field: "#image-upload",   // Default: .image-upload
                preview_box: "#image-preview",  // Default: .image-preview
                label_field: "#image-label",    // Default: .image-label
                label_default: "Pilih Foto",   // Default: Choose File
                label_selected: "Ganti Foto",  // Default: Change File
                no_label: false,                // Default: false
                success_callback: null          // Default: null
            });

            $('input:radio[name="overseas_check"]').change(function() {
                if ($(this).val() == 'yes') {
                    $('#overseas').prop('disabled', false);
                } else {
                    $('#overseas').val('');
                    $('#overseas').prop('disabled', true);
                }
            });

            @if(!empty($data->kelurahan))
              var provinsi = new Option("{{$data->kelurahan->kecamatan->kota->provinsi->name}}", "{{$data->kelurahan->kecamatan->kota->provinsi->id}}", true, true);
              $('#provinsi_id').append(provinsi).trigger('change');
              var kota = new Option("{{$data->kelurahan->kecamatan->kota->name}}", "{{$data->kelurahan->kecamatan->kota->id}}", true, true);
              $('#kota_id').append(kota).trigger('change');
              var kecamatan = new Option("{{$data->kelurahan->kecamatan->name}}", "{{$data->kelurahan->kecamatan->id}}", true, true);
              $('#kecamatan_id').append(kecamatan).trigger('change');
              var kelurahan = new Option("{{$data->kelurahan->name}}", "{{$data->kelurahan->id}}", true, true);
              $('#kelurahan_id').append(kelurahan).trigger('change');
            @endif

            $('#provinsi_id').select2({
                placeholder: 'Pilih...',
                ajax: {
                  url: '{{ route('wilayah') }}',
                  data: function (params) {
                    var query = {
                        type: 'provinsi',
                      search: params.term,
                    }
                    return query;
                  },
                  processResults: function (data) {
                    return {
                      results:  $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                  },
                }
            });

            $('#provinsi_id').on('select2:select', function (e) {
                var data = e.params.data;
                $('#kota_id').val(null).trigger('change');
                $('#kecamatan_id').val(null).trigger('change');
                $('#kecamatan_id').attr('disabled', true);
                $('#kelurahan_id').val(null).trigger('change');
                $('#kelurahan_id').attr('disabled', true);

                $('#kota_id').attr('disabled', false);
                $('#kota_id').select2({
                    placeholder: 'Pilih...',
                    ajax: {
                      url: '{{ route('wilayah') }}',
                      data: function (params) {
                        var query = {
                            type: 'kota',
                            data: data.id,
                            search: params.term,
                        }
                        return query;
                      },
                      processResults: function (data) {
                        return {
                          results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                      },
                    }
                });
            });

            $('#kota_id').on('select2:select', function (e) {
                var data = e.params.data;
                $('#kecamatan_id').val(null).trigger('change');
                $('#kecamatan_id').attr('disabled', true);
                $('#kelurahan_id').val(null).trigger('change');
                $('#kelurahan_id').attr('disabled', true);

                $('#kecamatan_id').attr('disabled', false);
                $('#kecamatan_id').select2({
                    placeholder: 'Pilih...',
                    ajax: {
                      url: '{{ route('wilayah') }}',
                      data: function (params) {
                        var query = {
                            type: 'kecamatan',
                            data: data.id,
                            search: params.term,
                        }
                        return query;
                      },
                      processResults: function (data) {
                        return {
                          results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                      },
                    }
                });
            });

            $('#kecamatan_id').on('select2:select', function (e) {
                var data = e.params.data;
                $('#kelurahan_id').val(null).trigger('change');
                $('#kelurahan_id').attr('disabled', true);

                $('#kelurahan_id').attr('disabled', false);
                $('#kelurahan_id').select2({
                    placeholder: 'Pilih...',
                    ajax: {
                      url: '{{ route('wilayah') }}',
                      data: function (params) {
                        var query = {
                            type: 'kelurahan',
                            data: data.id,
                            search: params.term,
                        }
                        return query;
                      },
                      processResults: function (data) {
                        return {
                          results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                      },
                    }
                });
            });

            @if(!empty($data->kelurahan_domisili))
              var provinsiTinggal = new Option("{{$data->kelurahan_domisili->kecamatan->kota->provinsi->name}}", "{{$data->kelurahan_domisili->kecamatan->kota->provinsi->id}}", true, true);
              $('#provinsi_tinggal').append(provinsiTinggal).trigger('change');
              var kotaTinggal = new Option("{{$data->kelurahan_domisili->kecamatan->kota->name}}", "{{$data->kelurahan_domisili->kecamatan->kota->id}}", true, true);
              $('#kota_tinggal').append(kotaTinggal).trigger('change');
              var kecamatanTinggal = new Option("{{$data->kelurahan_domisili->kecamatan->name}}", "{{$data->kelurahan_domisili->kecamatan->id}}", true, true);
              $('#kecamatan_tinggal').append(kecamatanTinggal).trigger('change');
              var kelurahanTinggal = new Option("{{$data->kelurahan_domisili->name}}", "{{$data->kelurahan_domisili->id}}", true, true);
              $('#kelurahan_tinggal').append(kelurahanTinggal).trigger('change');
            @endif

            $('#provinsi_tinggal').select2({
                placeholder: 'Pilih...',
                ajax: {
                  url: '{{ route('wilayah') }}',
                  data: function (params) {
                    var query = {
                        type: 'provinsi',
                      search: params.term,
                    }
                    return query;
                  },
                  processResults: function (data) {
                    return {
                      results:  $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                  },
                }
            });

            $('#provinsi_tinggal').on('select2:select', function (e) {
                var data = e.params.data;
                $('#kota_tinggal').val(null).trigger('change');
                $('#kecamatan_tinggal').val(null).trigger('change');
                $('#kecamatan_tinggal').attr('disabled', true);
                $('#kelurahan_tinggal').val(null).trigger('change');
                $('#kelurahan_tinggal').attr('disabled', true);

                $('#kota_tinggal').attr('disabled', false);
                $('#kota_tinggal').select2({
                    placeholder: 'Pilih...',
                    ajax: {
                      url: '{{ route('wilayah') }}',
                      data: function (params) {
                        var query = {
                            type: 'kota',
                            data: data.id,
                            search: params.term,
                        }
                        return query;
                      },
                      processResults: function (data) {
                        return {
                          results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                      },
                    }
                });
            });

            $('#kota_tinggal').on('select2:select', function (e) {
                var data = e.params.data;
                $('#kecamatan_tinggal').val(null).trigger('change');
                $('#kecamatan_tinggal').attr('disabled', true);
                $('#kelurahan_tinggal').val(null).trigger('change');
                $('#kelurahan_tinggal').attr('disabled', true);

                $('#kecamatan_tinggal').attr('disabled', false);
                $('#kecamatan_tinggal').select2({
                    placeholder: 'Pilih...',
                    ajax: {
                      url: '{{ route('wilayah') }}',
                      data: function (params) {
                        var query = {
                            type: 'kecamatan',
                            data: data.id,
                            search: params.term,
                        }
                        return query;
                      },
                      processResults: function (data) {
                        return {
                          results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                      },
                    }
                });
            });

            $('#kecamatan_tinggal').on('select2:select', function (e) {
                var data = e.params.data;
                $('#kelurahan_tinggal').val(null).trigger('change');
                $('#kelurahan_tinggal').attr('disabled', true);

                $('#kelurahan_tinggal').attr('disabled', false);
                $('#kelurahan_tinggal').select2({
                    placeholder: 'Pilih...',
                    ajax: {
                      url: '{{ route('wilayah') }}',
                      data: function (params) {
                        var query = {
                            type: 'kelurahan',
                            data: data.id,
                            search: params.term,
                        }
                        return query;
                      },
                      processResults: function (data) {
                        return {
                          results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                      },
                    }
                });
            });

            //Penyakit
            var i = 0;
            $(".add-more").click(function(){
                i++;
                var field = '<div class="copy"><div class="row idForm-'+i+'"> <div class="col-md-6"> <div class="form-group"> <label for="penyakit" class="control-label">Nama Penyakit</label> <input placeholder="Penyakit..." class="form-control" name="penyakit[]" type="text" id="penyakit"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="tahun_sakit" class="control-label">Tahun</label> <div class="input-group mb-3"> <input placeholder="Tahun sakit..." class="form-control" name="tahun_sakit[]" type="text" id="tahun_sakit"> <div class="input-group-append"> <button data-id="'+i+'" class="remove btn btn-danger" type="button"><i class="fas fa-minus"></i></button> </div> </div> </div> </div> </div></div>';
                var html = $(field).html();
                $(".field").append(html);
            });

            $('body').on('click', '.remove', function(e){
                var click_id = $(this).data("id");
                $(".idForm-"+click_id+"").remove();
            });

            //Minat Bakat
            var x = 0;
            $(".add-bahasa").click(function(){
                x++;
                var field = '<div class="copy"><div class="row idBahasa-'+x+'"><div class="col-md-6"><div class="form-group"><label for="bahasa[]" class="control-label">Nama Bahasa</label><input placeholder="Bahasa..." class="form-control" name="bahasa[]" type="text" value="" id="bahasa[]"></div></div><div class="col-md-6"><div class="form-group"><label for="file_bahasa[]" class="control-label">Scan sertifikat</label><div class="input-group mb-3"><input class="form-control" name="file_bahasa[]" type="file" id="file_bahasa[]"><div class="input-group-append"> <button data-id="'+x+'" class="remove-bahasa btn btn-danger" type="button"><i class="fas fa-minus"></i></button> </div> </div> </div> </div> </div></div>';

                var html = $(field).html();
                $(".field-bahasa").append(html);
            });

            $('body').on('click', '.remove-bahasa', function(e){
                var click_id = $(this).data("id");
                $(".idBahasa-"+click_id+"").remove();
            });

            $('#jenis_asuransi').on('select2:select', function(e) {
              var data = e.params.data;
              $('#asuransi').prop('readonly', true);
              $('#asuransi').val(data.text);
              if(data.id == 'lain') {
                $('#asuransi').val('');
                $('#asuransi').prop('readonly', false);
              }
            })
            $('#jenis_asuransi').on('select2:unselect', function() {
              $('#asuransi').val('');
              $('#asuransi').prop('readonly', true);
            })

            $('#jenis_kartu').on('select2:select', function(e) {
              var data = e.params.data;
              $('#kartu').prop('readonly', true);
              $('#kartu').val(data.text);
              if(data.id == 'lain') {
                $('#kartu').val('');
                $('#kartu').prop('readonly', false);
              }
            })
            $('#jenis_kartu').on('select2:unselect', function() {
              $('#kartu').val('');
              $('#kartu').prop('readonly', true);
            })
        });
    </script>