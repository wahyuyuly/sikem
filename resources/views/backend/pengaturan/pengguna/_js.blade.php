<script>
    $(document).ready(function() {
        $("select").selectric();
        
        @if(isset($data->photo))
            $('#image-preview').css('background-image', 'url("{{ asset('storage/photos/'.$data->photo) }}")');
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
    });
</script>