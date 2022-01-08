var project_id = $("#tdg_project_name").data("ivalue");
$(document).ready(function () {

    console.log(project_id);
    $("#assign_input").typeahead({

        source: function (que, result) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '../all-member',
                data: {
                    que: que,
                },
                //   dataType: "json",
                success: function (data) {
                    console.log(data);
                    let tempData = [];
                    data.map(item => tempData.push(`${item.id}. ${item.name}`));
                    console.log(tempData);
                    result(tempData);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });

        }

    });
    $("#add_member2project").typeahead({

        source: function (que, result) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '.../exiting-member',
                data: {
                    que: que,
                    p_id: project_id,
                },
                //   dataType: "json",
                success: function (data) {
                    console.log(data);
                    let tempData = [];
                    data.map(item => tempData.push(`${item.id}. ${item.name}`));
                    //console.log(tempData);
                    result(tempData);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });

        }

    });
    $("#client").typeahead({

        source: function (que, result) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '../all-client',
                data: {
                    que: que,
                    p_id: project_id,
                },
                //   dataType: "json",
                success: function (data) {
                    console.log(data);
                    let tempData = [];
                    data.map(item => tempData.push(`${item.id}. ${item.name}`));
                    //console.log(tempData);
                    result(tempData);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });

        }

    });

});


