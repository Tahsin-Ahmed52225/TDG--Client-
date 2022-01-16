$(document).ready(function () {
    //Getting the project ID
    var id = $("#tdg_project_name").data("ivalue");
    //Adding new subtask on create button click
    $("#create_task").click(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: '../get_new_task_id',
            data: {
                project_id: id,
            },
            success: function (data) {
                addTask(data);
                console.log(data);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
    //Updating subtask status on checkbox click
    $("#task_board").on('change', '.task_checkbox', function (e) {
        console.log($(e.target).data("id"));
        changeStage($(e.target).data("id"));
    });
    //Updating subtask on double click
    $("#task_board").on('dblclick', '.sub_task_title', function (e) {
        updateTask(e, $(this).data("id"));
    });
    //Deleteing subtask on delete button click
    $("#task_board").on('click', '.sub_task_delete', function (e) {
        // alert($(this).data("id"));
        deleteSubtask($(this).data("id"));
    });

    // Adding new subtask field into frontend
    function addTask(data) {
        let task = `<div class="d-flex align-items-center mt-3" id="task` + data + `">
            <!--begin::Bullet-->
            <span class="bullet bullet-bar bg-success align-self-stretch"></span>
            <!--end::Bullet-->
            <!--begin::Checkbox-->
            <label class="checkbox checkbox-lg checkbox-light-success checkbox-inline flex-shrink-0 m-0 mx-4">
                <input type="checkbox" name="select" data-id=`+ data + ` class="task_checkbox" />
                <span></span>
            </label>
            <!--end::Checkbox-->
            <!--begin::Text-->
            <div class="d-flex flex-column flex-grow-1"  >
                <div class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1 sub_task_title" id="taskname`+ data + `"  data-id=` + data + ` style="margin-top:4px; height:20px;"></div>
            </div>
            <!--end::Text-->
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline ml-2">
            <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ki ki-bold-more-hor"></i>
            </a>
            <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                <!--begin::Navigation-->
                <ul class="navi navi-hover">
                    <li class="navi-item bg-light-danger rounded">
                            <a  class="sub_task_delete navi-link"  data-id=` + data + `
                                <span class="navi-text">
                                    Delete Task
                                </span>
                            </a>
                    </li>
                </ul>
                <!--end::Navigation-->
            </div>
        </div>
            </div>
            <!--end::Dropdown-->
        </div>`
        $('#task_board').append(task);
    }


    //Save Subtask title
    function saveTask(text, i) {
        $.ajax({
            type: 'GET',
            url: '../update_subtask_title',
            data: {
                project_id: id,
                subtask_id: i,
                subtask_title: text
            },
            success: function (data) {
                console.log(data);
                $('.toast').toast("show");
                //    $('.toast').toast("delay") = 1000;
                $('.toast-body').text("Project Subtask Updated Successfully");

            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    };

    //Update Subtask title
    function updateTask(event, id) {

        // console.log(event.target);
        $(event.target).attr('contenteditable', 'true');
        $(event.target).keyup(function () {
            if (window.event.keyCode === 13) {
                event.preventDefault();
                $(event.target).attr('contenteditable', 'false');
                saveTask($(event.target).text(), id);
            } else {
                if ($(event.target).text().length >= 40) {
                    alert("Subtask title should be less than 42 characters");
                    $(event.target).attr('contenteditable', 'false');
                }
                //console.log();
            }
        });
    };
    //Change Subtask status
    function changeStage(id) {
        $.ajax({
            type: 'GET',
            url: '../update_subtask_status',
            data: {
                subtask_id: id,
            },
            success: function (data) {
                console.log(data);
                $('.toast').toast("show");
                $('.toast-body').text("Project Subtask Status Changed");
                $('#taskname' + id).css('text-decoration', data == 1 ? 'line-through' : 'none');
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });

    }
    //Delete Subtask
    function deleteSubtask(id) {
        $.ajax({
            type: 'GET',
            url: '../delete-project-task',
            data: {
                subtask_id: id,
            },
            success: function (data) {
                if (data.success) {
                    $('.toast').toast("show");
                    $('.toast-body').text("Project Subtask Deleted Successfully");
                    $('#task' + id).fadeOut("normal", function () {
                        $(this).remove();
                    });
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });

    }
});
