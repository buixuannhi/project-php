<script>
    $(document).ready(function() {
        // Slect Sigle Input
        $('tr').click(function () {
            const position = $(this).attr("data-position");

            $(`#select-position-${position}`).prop('checked', function (index, value) {
            return !value;
            });
        });

        // Slect All
        $("#select-all").click(function (event) {
            if (this.checked) {
                $(":checkbox").each(function () {
                this.checked = true;
            });
            } else {
                $(":checkbox").each(function () {
                this.checked = false;
            });
        }
    });
});
</script>
