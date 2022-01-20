window.onload = function () {
    function updateSubTaskDescription(subtask_id, description) {
        $.ajax({
            url: '/manager/update-subtask-description',
            type: 'GET',
            data: {
                subtask_id: subtask_id,
                description: description
            },
            success: function (data) {
                if (data.status == 'success') {
                    $('#subtask_description_' + subtask_id).html(description);
                }
            }
        });
    }
    $("#task_board").on("dblclick", ".sub_task_description", function () {
        $(this).prop("contenteditable", true);
        $(this).focus();
        $(this).on("keypress", function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                if ($(this).text() === "") {
                    // $(this).text("P");
                } else {
                    $(this).prop("contenteditable", false);
                    $(this).html(function () {
                        $(this).html = $(this).html().replace(/(?:&nbsp;|<br>)/, '');
                    });
                    updateSubTaskDescription($(this).data("ivalue"), $(this).html());

                }


            }
        });
    });
}
