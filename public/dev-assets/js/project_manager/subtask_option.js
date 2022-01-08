$(window).on("load", function () {
    // $(".navi-item").delegate(".subtask_delete", "click", function () {
    //     // alert($(this).data("id"));
    //     $.ajax({
    //         type: 'GET',
    //         url: '../delete-subtask',
    //         data: {
    //             project_id: id,
    //             task_id: $(this).data("id"),
    //         },
    //         success: function (data) {
    //             console.log("I am here" + data);
    //             // var new_task = { id: data, task: '', stage: false };
    //             // alltask[0] = new_task;
    //             // addTask(alltask);
    //         },
    //         error: function (xhr) {
    //             console.log(xhr.responseText);
    //         },
    //     });
    // });
    // $("#task_board > div > .dropdown > .dropdown-menu > .navi > .subtask_delete").on("click", function (e) {
    //     alert($(this).data("id"));
    // });
    function delete_task(task_id) {
        alert(task_id);
    }


});
