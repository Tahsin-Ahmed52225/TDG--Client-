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
    $("#"+$option+$id).attr('contenteditable','false');
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
        console.log("done");

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


