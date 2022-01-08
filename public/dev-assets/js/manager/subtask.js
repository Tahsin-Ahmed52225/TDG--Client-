$(document).ready(function () {
    //Getting the project ID
    var id = $("#tdg_project_name").data("ivalue");

    // Adding new subtask field into frontend
    function addTask(data) {
        let task = `<div class="d-flex align-items-center mt-3">
        <!--begin::Bullet-->
        <span class="bullet bullet-bar bg-success align-self-stretch"></span>
        <!--end::Bullet-->
        <!--begin::Checkbox-->
        <label class="checkbox checkbox-lg checkbox-light-success checkbox-inline flex-shrink-0 m-0 mx-4">
            <input type="checkbox" name="select"  onchange="stageChange(event, `+ data + `)" />
            <span></span>
        </label>
        <!--end::Checkbox-->
        <!--begin::Text-->
        <div class="d-flex flex-column flex-grow-1"  ondblclick="updateTask(event, `+ data + `)">
            <div class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1" id="tasklabel`+ data + `" style="margin-top:4px; height:20px;"></div>
        </div>
        <!--end::Text-->
        <!--begin::Dropdown-->
        <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
            <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ki ki-bold-more-hor"></i>
            </a>
            <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                <!--begin::Navigation-->
                <ul class="navi navi-hover">
                    <li class="navi-header font-weight-bold py-4">
                        <span class="font-size-lg">Choose Label:</span>
                        <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                    </li>
                    <li class="navi-separator mb-3 opacity-70"></li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-text">
                                <span class="label label-xl label-inline label-light-success">Customer</span>
                            </span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-text">
                                <span class="label label-xl label-inline label-light-danger">Partner</span>
                            </span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-text">
                                <span class="label label-xl label-inline label-light-warning">Suplier</span>
                            </span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-text">
                                <span class="label label-xl label-inline label-light-primary">Member</span>
                            </span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-text">
                                <span class="label label-xl label-inline label-light-dark">Staff</span>
                            </span>
                        </a>
                    </li>
                    <li class="navi-separator mt-3 opacity-70"></li>
                    <li class="navi-footer py-4">
                        <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                    </li>
                </ul>
                <!--end::Navigation-->
            </div>
        </div>
        <!--end::Dropdown-->
    </div>`
        $('#task_board').append(task);
    }
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
                console.log(data);
                addTask(data);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
    //Updating subtask on double click
    $("sub_task_title").on('dblclick', function (e) {
        console.log(e);
    });
});
