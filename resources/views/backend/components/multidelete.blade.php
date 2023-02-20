<script>
    $('#deldata').on('click', function() {
        var data = $('#dataList input[type="checkbox"]').serializeArray();
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var url = '{{ $slot }}';

        swal({
            title: 'Anda Yakin?',
            text: "Data yang ditandai akan dihapus dari pangkalan data!",
            icon: 'warning',
            buttons: {
                cancel: "Batalkan",
                confirm: "Tetap Hapus",
            },
            dangerMode: true,
        }).then((value) => {
            if(value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        '_token': csrf_token,
                        '_method': 'DELETE',
                        'data': data
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
</script>