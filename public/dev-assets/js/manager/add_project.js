$(window).on('load', function () {
    $('#client_project_info').hide();
    $("#project_type").on('change', function () {
        if ($(this).val() == 'client') {
            $('#client_project_info').show();
        } else {
            $('#client_project_info').hide();
        }
    });
});
