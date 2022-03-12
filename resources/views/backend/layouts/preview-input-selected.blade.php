<script>
    $('#summernote').summernote({
        placeholder: "Describe your room...",
        height: 300,
        minHeight: 150,
        maxHeight: 500,
    });

    $('#category_image').change(function (e) {
        var file = e.originalEvent.srcElement.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            $('#image-show').css('display', 'block');
            $('#image-show').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    });

    $('#room_avatar').change(function (e) {
        var file = e.originalEvent.srcElement.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            $('#image-show').css('display', 'block');
            $('#image-show').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    });

    $('#image_details').change(function (e) {

        if (this.files) {

            $('.image-show-detail').empty();

            for (var i = 0; i < this.files.length; i++) {

                const file = this.files[i];

                const reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-show-detail').append($("<img/>", {src: event.target.result, width: 135, height: 120, class: 'px-2 py-3'}));
                };

                reader.readAsDataURL(file);
            }
        }
    });
</script>
