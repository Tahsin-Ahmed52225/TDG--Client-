

function deleteMember($id){
    $.ajax({
        type : 'get',
        url : '/admin/delete-member',
        data:{'data':$id},
        success:function(data){
            var row =  "row"+$id;
           // alert(row);
            $("#"+row).fadeTo("slow",0.2, function(){
                $(this).remove();
                $('div.flash-message').html(data);
            })

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
})
}
function updateMember($id , $option , $value){
    console.log(`id: ${$id}`);
    console.log(typeof($id));
    console.log(`option: ${$option}`);
    console.log(`value: ${$value}`);

    if($option != "position"){
        $("#"+$option+$id).attr('contenteditable','false');
    }else{
        $("#position"+$id).css('display','block');
        $("#position-edit"+$id).css('display','none');
    }

    $.ajax({
        type : 'get',
        url : '/admin/update-member',
        data:{
               'id':$id ,
               'option':$option ,
               'value':$value
         },
        success:function(data){
        $('div.flash-message').html(data);
       // console.log("done");

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
})


}
function updateName($id){

    $("#name"+$id).attr('contenteditable','true');
    var input = document.getElementById("name"+$id);

    input.addEventListener("keypress", function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
           // console.log($("#name"+$id).text());
            $("#name"+$id).html(function(){
                $("#name"+$id).html  = $("#name"+$id).html().replace(/(?:&nbsp;|<br>)/g,'');
            });
            console.log($("#name"+$id).html());
           updateMember($id,"name",$("#name"+$id).text() )

        }
      });
}
function updateEmail($id){
    $("#email"+$id).attr('contenteditable','true');
    var input = document.getElementById("email"+$id);

    input.addEventListener("keypress", function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
           // console.log($("#name"+$id).text());
            updateMember($id,"email",$("#email"+$id).text() )

        }
      });
}
function updatePhone($id){
    $("#number"+$id).attr('contenteditable','true');
    var input = document.getElementById("number"+$id);

    input.addEventListener("keypress", function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
           // console.log($("#name"+$id).text());
            updateMember($id,"number",$("#number"+$id).text() )

        }
      });
}
function updatePosition($id){
    $("#position"+$id).css('display','none');
    $("#position-edit"+$id).css('display','block');
    var input = document.getElementById("positionD"+$id);
    input.addEventListener("change", function(event) {

           $msg = "positionD"+$id+" :selected"

    //console.log();
          updateMember($id,"position",$('#'+$msg).text())

         $("#position"+$id).text($('#'+$msg).text());
      });

}

// function switchT($id,$stage){
//     if($stage == 1){
//          $stage = 0;
//     }else{
//          $stage = 1;
//     }
//     updateMember($id,"stage",$stage);
// }


function switchT(id, stage){
    stage = stage ? 0 : 1;
    updateMember(id, "stage", stage);
}
