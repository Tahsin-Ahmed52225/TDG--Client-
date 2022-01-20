//Updateing project name ( ajax call )
function updateProjectName(project_id, project_name) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/manager/update-project-name",
        data: {
            project_id: project_id,
            project_name: project_name,
        },
        success: function (data) {
            console.log(data.success);
        }
    });

}
//Updateing project description ( ajax call )
function updateProjectDescription(project_id, project_description) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/manager/update-project-description",
        data: {
            project_id: project_id,
            project_description: project_description,
        },
        success: function (data) {
            console.log(data.success);
        }
    });

}

// Double click on project name to update project name
$("#tdg_project_name").on("dblclick", function () {
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
                    $(this).html = $(this).html().replace(/(&nbsp;|<br>)/, '');
                });
                updateProjectName($(this).data("ivalue"), $(this).html());

            }


        }
    });

});
// Double click on project description to update project description
$("#tdg_project_description").on("dblclick", function () {
    $(this).prop("contenteditable", true);
    $(this).focus();
    $(this).on("keypress", function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if ($(this).text() === "") {

            } else {
                $(this).prop("contenteditable", false);
                $(this).html(function () {
                    $(this).html = $(this).html().replace(/(?:&nbsp;|<br>)/, '');
                });
                updateProjectDescription($(this).data("ivalue"), $(this).html());
            }
        }
    });

});
