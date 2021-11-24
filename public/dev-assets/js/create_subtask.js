var alltask = [];
var id = $("#tdg_project_name").data("ivalue");
function saveTask(alltask ,id,i){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type : 'POST',
        url : '../cnst',
        data:{
            task : alltask ,
            ids : id ,
            task_id : i,
        },
        success:function(data){
            console.log("Returned size:"+data);
            console.log("Task id sent:"+i);

        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
  });
}

function updateTask(event,i){

  // console.log(event.target);
   $(event.target).attr('contenteditable','true');
   $(event.target).keyup(function(){
    if (window.event.keyCode === 13) {
        event.preventDefault();
        saveTask(alltask , id , i);
        $(event.target).attr('contenteditable','false');
      }else{
        if(alltask.length == 0){
            console.log(i);
            var new_task ={ id: i , task: $(event.target).text() , stage: false};
            alltask[0] = new_task ;
        }else{
            alltask[0].task = $(event.target).text();
        }

      }
   });
};
function stageChange(event, i){
    $.ajax({
        type : 'GET',
        url : '../gots',
        data:{
            project_id : id ,
            task_id : i,
        },
        success:function(data){
            if(data == 'true'){
                $(`#tasklabel`+i).css("text-decoration",  "line-through");
            }else{
                $(`#tasklabel`+i).css("text-decoration",  "none");
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

function addTask(alltask){
    let task = `<div class="d-flex align-items-center mt-3">
    <!--begin::Bullet-->
    <span class="bullet bullet-bar bg-success align-self-stretch"></span>
    <!--end::Bullet-->
    <!--begin::Checkbox-->
    <label class="checkbox checkbox-lg checkbox-light-success checkbox-inline flex-shrink-0 m-0 mx-4">
        <input type="checkbox" name="select" value="1" onchange="stageChange(event, `+alltask[0].id+`)" />
        <span></span>
    </label>
    <!--end::Checkbox-->
    <!--begin::Text-->
    <div class="d-flex flex-column flex-grow-1"  ondblclick="updateTask(event, `+alltask[0].id+`)">
        <div class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1" id="tasklabel`+alltask[0].id+`" style="margin-top:4px; height:20px;"></div>
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

$(document).ready(function(){

   $("#create_task").click(function(event){
        event.preventDefault();
        $.ajax({
            type : 'GET',
            url : '../gntid',
            data:{
                project_id : id ,
            },
            success:function(data){
                console.log("new task id"+data);
                var new_task ={ id: data , task: '' , stage: false};
                alltask[0]= new_task;
                addTask(alltask);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });

      // i++;
   });

});

