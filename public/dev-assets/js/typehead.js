
$(document).ready(function() {
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
             //   console.log(data);
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
});


