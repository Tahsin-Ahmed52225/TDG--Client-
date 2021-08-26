document.getElementById("submit_button").addEventListener("click", function() {
    var data = [];
    data["project_name"] = $("#tdg_project_name").val();
   // data["assign_members"] =  $("#tdg_project_name").val();
    data["due_date"] = $("#tdg_project_date").val();
    data["status"] =  $('#tdg_project_status :selected').text()
    data["priority"] =  $('#tdg_project_priority :selected').text()
    data["budget"] = $("#tdg_project_budget").val();
    data["client_id"] = $("#tdg_client_ID").val();
    data["description"] = $("#tdg_project_description").val();
    var files = $(".tdg_project_name").val();


    console.log(data["project_name"]);
    console.log($("#tdg_assignee_member").tagsinput('items'));
    console.log(data["due_date"]);
    console.log(data["status"]);
    console.log(data["priority"]);
    console.log(data["budget"]);
    console.log(data["client_id"]);
    console.log(data["description"]);
    //console.log($(this.ss);

        //     $.ajax({
        //         type : 'post',
        //         url : '/manager/add-project',
        //         data:{
        //             'project_name': data["project_name"],
        //             'assignee_member': $("#tdg_assignee_member").tagsinput('items'),
        //             'dute_date': data["due_date"],
        //             'status': data["status"],
        //             'priority' : data["priority"],
        //             'budget': data["budget"],
        //             'client_id': data["client_id"],
        //             'description': data["description"],
        //         },
        //         success:function(data){
        //         $('div.flash-message').html(data);
        //     // console.log("done");

        //         },
        //         error: function (xhr, status, error) {
        //             console.log(xhr.responseText);
        //         },
        // })
  });
