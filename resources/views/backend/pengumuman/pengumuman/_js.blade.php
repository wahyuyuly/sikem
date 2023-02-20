<script>
    'use strict';
    $(document).ready(function() {
        $("select").selectric();

        @if(isset($data->image))
            $('#image-preview').css('background-image', 'url("{{ asset('storage/pengumuman/cover/'.$data->image) }}")');
            $('#image-preview').css('background-size', 'cover');
            $('#image-preview').css('background-position', 'center center');
        @endif

        $.uploadPreview({
            input_field: "#image-upload",   // Default: .image-upload
            preview_box: "#image-preview",  // Default: .image-preview
            label_field: "#image-label",    // Default: .image-label
            label_default: "Pilih Foto",   // Default: Choose File
            label_selected: "Ganti Foto",  // Default: Change File
            no_label: false,                // Default: false
            success_callback: null          // Default: null
        });

        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            fileUpload: false,
        };

        CKEDITOR.on('dialogDefinition', function(ev) {
            var dialogName = ev.data.name,
                dialogDefinition = ev.data.definition;
            if (dialogName === 'image') {
                dialogDefinition.removeContents('Upload');
            }
        });
        CKEDITOR.stylesSet.add( 'default', [
            // Block Styles
            { name: 'List', element: 'ol', attributes: { "class": "list mark-list" } },
            { name: 'Red Title', element: 'h3', styles: { 'color': 'Red' } },
        ] );

        CKEDITOR.replace('content', options);
        CKEDITOR.config.height = 300;
    });
</script>