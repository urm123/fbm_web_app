(function ($) {

    /*Convert SVG image in inline svg format*/
    jQuery('img.svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, else we gonna set it if we can.
            if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });


    /*add active class for menu*/
    var url = window.location;
    $('ul a[href="' + url + '"]').parent().addClass('active');
    $('ul a').filter(function () {
        return this.href == url;
    }).parent().addClass('active');


    /*common control*/

    /*Chane cards scrollbars*/
    $(window).on("load", function () {
        $(".card .Scroll").mCustomScrollbar({
            theme: "minimal-dark"
        });
    });

    /*enable cards tabs*/
    $('#myTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });


    /*form control*/
    /*Checkbox*/

    $(".checkbox input[type=checkbox]").change(function () {
        if (this.checked) {
            $('.checkbox .cr').css('background-color', '#11CD86');
        } else {
            $('.checkbox .cr').css('background-color', 'transparent');
        }
    });


    if (".checkbox input[type=checkbox]:checked") {
        $('.checkbox .cr').css('background-color', '#11CD86');
    } else {
        $('.checkbox .cr').css('background-color', 'transparent');
    }


    /*Product Cost Monitoring*/

    $('.Edit').click(editRow);

    $('.Save').click(saveRow);

    $('.Cancel').click(cancelRow);

    /*Edittable table content*/
    // disable input editable
    $("table.editable .form-control").prop('disabled', true);
    $("table.editable").addClass('selectable');

    function editRow(event) {
        event.preventDefault();
        //desable edit btn
        $(".Edit").off("click");
        $(".editable").off("click", ".Edit", editRow);
        //get currunt row
        currentTD = $(this).parents('tr').find('td');
        $.each(currentTD, function () {

            $("table.editable").removeClass('selectable');

            $(this).addClass('activetd');
            $(".activetd .form-control").prop('disabled', false);

            $('.activetd .Edit svg').removeClass('show');
            $('.activetd .Edit svg').addClass('hide');
            $('.activetd .Save svg').addClass('show');
            $('.activetd .Cancel svg').addClass('show');

            //get currunt values for undo
            $('input').each(function (curIdx, curO) {
                $(curO).attr('default-value', $(curO).val());
            });
        });

    }

    function saveRow() {
        //get currunt row
        currentTD = $(this).parents('tr').find('td');
        $.each(currentTD, function () {
            $('.activetd .Edit svg').addClass('show');
            $('.activetd .Save svg').removeClass('show');
            $('.activetd .Save svg').addClass('hide');
            $('.activetd .Cancel svg').removeClass('show');
            $('.activetd .Cancel svg').addClass('hide');

            $(".form-control").prop('disabled', true);
            $(this).removeClass('activetd');
            $("table.editable").addClass('selectable');

        });

        //enable edit btn
        $(".editable").on("click", ".Edit", editRow);

    }

    function cancelRow() {
        //get currunt row
        currentTD = $(this).parents('tr').find('td');
        $.each(currentTD, function () {

            $('.activetd .Edit svg').addClass('show');
            $('.activetd .Save svg').removeClass('show');
            $('.activetd .Save svg').addClass('hide');
            $('.activetd .Cancel svg').removeClass('show');
            $('.activetd .Cancel svg').addClass('hide');
            // undo
            $('input').each(function (curIdx, curO) {
                $(curO).val($(curO).attr('default-value'));
            });

            $(".form-control").prop('disabled', true);
            $(this).removeClass('activetd');
            $("table.editable").addClass('selectable');

        });
        //enable edit btn
        $(".editable").on("click", ".Edit", editRow);
    }


    /*Loding Dtails model openig*/
    $("#filterbyname").click(function () {
        $('#FilterModal').modal('show');
    });

    $("#filterbyname2").click(function () {
        $('#FilterModal').modal('show');
    });

    // $('#user-icon').hover(function () {
    //     $('#logout-button').stop(true, false).slideDown(200);
    // }, function () {
    //     $('#logout-button').stop(true, false).slideUp(200);
    // });
})(jQuery);



