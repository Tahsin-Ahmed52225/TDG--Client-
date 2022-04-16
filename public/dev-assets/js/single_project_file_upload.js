const inputElement = document.querySelector('input[name="fileUpload"]');
const pond = FilePond.create(inputElement);
pond.allowMultiple = false;

pond.setOptions({
    server: {
        url: './temp-project-upload',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        process: {
            onload: (response) => {
                console.log(response);
            },
        },
    }
});


