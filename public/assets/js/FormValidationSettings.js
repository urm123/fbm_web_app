window.addEventListener('load', function () {

    (function ($) {

        /*change file upload icon*/
        $(document).on('click', '.browse', function () {
            var file = $(this).parent().parent().parent().find('.file');
            file.trigger('click');
        });
        $(document).on('change', '.file', function () {
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });

        /*enable datepiker*/
        $(function () {
            $('.inputdate').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
        /*enable timepiker*/
        $(function () {
            $('.inputtime').datetimepicker({
                format: 'LT'
            });
        });


    })(jQuery);
});