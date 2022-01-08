var alltask = [];
var id = $("#tdg_project_name").data("ivalue");
function delete_task(i) {
    $.ajax({
        type: 'GET',
        url: '../delete-subtask',
        data: {
            project_id: id,
            task_id: i,
        },
        success: function (data) {
            console.log("I am here" + data);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
    });
}
function saveTask(alltask, id, i) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: '../cnst',
        data: {
            project_id: id,
            task: alltask,
            ids: id,
            task_id: i,
        },
        success: function (data) {
            console.log("Returned size:" + data);
            console.log("Task id sent:" + i);

        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
    });
}

function updateTask(event, i) {
    //console.log(event.target);
    $(event.target).attr('contenteditable', 'true');
    $(event.target).keyup(function () {
        if (window.event.keyCode === 13) {
            event.preventDefault();
            saveTask(alltask, id, i);
            $(event.target).attr('contenteditable', 'false');
        } else {
            if (alltask.length == 0) {
                console.log(i);
                var new_task = { id: i, task: $(event.target).text(), stage: false };
                alltask[0] = new_task;
            } else {
                alltask[0].task = $(event.target).text();
            }

        }
    });
};
function stageChange(event, i) {
    $.ajax({
        type: 'GET',
        url: '../gots',
        data: {
            project_id: id,
            task_id: i,
        },
        success: function (data) {
            if (data == 'true') {
                $(`#tasklabel` + i).css("text-decoration", "line-through");
            } else {
                $(`#tasklabel` + i).css("text-decoration", "none");
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
    });
    // alltask[i].stage = alltask[i].stage ? false : true ;
    // $(`#tasklabel`+i).css("text-decoration", alltask[i].stage ? "line-through": "none");
    //  console.log(alltask);
};

function addTask(alltask) {
    let task = `<div class="d-flex align-items-center mt-3">
    <!--begin::Bullet-->
    <span class="bullet bullet-bar bg-success align-self-stretch"></span>
    <!--end::Bullet-->
    <!--begin::Checkbox-->
    <label class="checkbox checkbox-lg checkbox-light-success checkbox-inline flex-shrink-0 m-0 mx-4">
        <input type="checkbox" name="select" value="1" onchange="stageChange(event, `+ alltask[0].id + `)" />
        <span></span>
    </label>
    <!--end::Checkbox-->
    <!--begin::Text-->
    <div class="d-flex flex-column flex-grow-1"  ondblclick="updateTask(event, `+ alltask[0].id + `)">
        <div class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1" id="tasklabel`+ alltask[0].id + `" style="margin-top:4px; height:20px;"></div>
    </div>
    <!--end::Text-->
    <div class="dropdown dropdown-inline ml-2">
    <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="ki ki-bold-more-hor"></i>
    </a>
    <div class="dropdown-menu p-0 m-0 dropdown-menu-sm   dropdown-menu-left">
        <!--begin::Navigation-->
        <ul class="navi bg-light-primary  navi-hover">
            <li class="navi-item ">
                <a  class="sub_task_assign navi-link" data-id= `+ alltask[0].id + `>
                    <span class="navi-text">
                       Assign Member
                    </span>
                </a>
             </li>
            <li class="navi-item subtask_delete"  onclick=delete_task(`+ alltask[0].id + `)>
                    <a  class="navi-link">
                        <span class="navi-text text-danger">
                           Delete Task
                        </span>
                    </a>
            </li>
        </ul>
        <!--end::Navigation-->
    </div>
</div>
</div>`
    $('#task_board').append(task);

}

$(document).ready(function () {

    $("#create_task").click(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: '../gntid',
            data: {
                project_id: id,
            },
            success: function (data) {
                console.log("I am here" + data);
                var new_task = { id: data, task: '', stage: false };
                alltask[0] = new_task;
                addTask(alltask);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });

        // i++;
    });
    // Deleting subtask from task
    $("#task_board > div > .dropdown > .dropdown-menu > .navi").delegate(".subtask_delete", "click", function (e) {
        delete_task($(this).data("id"));
    });

});



