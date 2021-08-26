$(document).ready(function(){
   $(".bootstrap-tagsinput input:first").attr('id', 'assign_input');
   $("#assign_input").typeahead({
      source : function(que, result)
      {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            url : './all-member',
            data:{
                que : que ,
            },
         //   dataType: "json",
            success:function(data){
                       // console.log(data);
                        result(data);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
      });

   }


    });

});