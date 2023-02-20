<script>
    $('#dataList tbody').on( 'click', '.restore', function () {
        var id = $(this).attr('id');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var url = '{{ $slot }}';
            url = url.replace(':id', id);
        swal({
            title: 'Anda Yakin?',
            text: "Data akan dipulihakn ke pangkalan data!",
            icon: 'warning',
            buttons: {
                cancel: "Batalkan",
                confirm: "Pulihkan",
            },
        }).then((value) => {
            if(value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
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
    });
</script>