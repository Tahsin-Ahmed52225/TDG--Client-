const url = "/project_manager/add-project-file/" + $("#tdg_project_name").data("ivalue");
const inputElement = document.querySelector('input[name="fileUpload"]');
const pond = FilePond.create(inputElement);
pond.allowMultiple = true;

pond.setOptions({
    server: {
        url: '/project_manager/add-project-file/' + $("#tdg_project_name").data("ivalue"),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        process: {
            onload: (response) => {

                if (response === "Success") {
                    setInterval('location.reload()', 4000);
                }
            },
        },
    }
});


