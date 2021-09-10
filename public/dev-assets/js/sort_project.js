var page = localStorage.getItem('view');
console.log(page);
if(page){
    if(page == 'board'){
        $("#board_view").css("display","block");
        $("#list_view").css("display","none");
    }else{
        $("#board_view").css("display","none");
        $("#list_view").css("display","block");
    }
}else{
    $("#board_view").css("display","none");
    $("#list_view").css("display","block");
}

function listview(){
    localStorage['view'] = 'list';
    var page = localStorage.getItem('view');
    console.log(page);
   $("#board_view").css("display","none");
   $("#list_view").css("display","block");
}
function boardview(){
    localStorage['view'] = 'board';
    var page = localStorage.getItem('view');
    console.log(page);
    $("#board_view").css("display","block");
    $("#list_view").css("display","none");
}


function searchIT(){
    $que =  document.getElementById("searchBox").value;
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type : 'POST',
        url : '../search-project',
        data:{
            que : $que,
        },
        success:function(data){
              $("#table_body").css('display', 'none');
             //  console.log(data[0]);
              if(data.length == 0){
                 // console.log("I am here");
                  $("#table_body").css('display', 'block')
                  $("#table_body").html('<tr > <td style="width:100%; border:none;"><div style="text-align: center;">No data found </div></td> </tr>');
              }else{
                  $("#table_body").css('display', '')
                  $("#table_body").html(data);
              }

        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
      });
}





function monthChange(e){
    var month = document.getElementById("select_month").value;
    var year = document.getElementById("select_year").value;
    if(year == 'none'){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            url : '../sort-by-month',
            data:{
                month : month,
            },
            success:function(data){
                  $("#table_body").css('display', 'none');
                 //  console.log(data[0]);
                  if(data.length == 0){
                     // console.log("I am here");
                      $("#table_body").css('display', 'block')
                      $("#table_body").html('<tr > <td style="width:100%; border:none;"><div style="text-align: center;">No data found </div></td> </tr>');
                  }else{
                      $("#table_body").css('display', '')
                      $("#table_body").html(data);
                  }

            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
          });

    }else{
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            url : '../sort-by-both',
            data:{
                month : month,
                year : year,
            },
            success:function(data){
                  $("#table_body").css('display', 'none');
                 //  console.log(data[0]);
                  if(data.length == 0){
                     // console.log("I am here");
                      $("#table_body").css('display', 'block')
                      $("#table_body").html('<tr > <td style="width:100%; border:none;"><div style="text-align: center;">No data found </div></td> </tr>');
                  }else{
                      $("#table_body").css('display', '')
                      $("#table_body").html(data);
                  }

            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
          });

    }


}
function yearChange(e){
    var year = document.getElementById("select_year").value;
    var month = document.getElementById("select_month").value;
    if(month == "none"){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            url : '../sort-by-year',
            data:{
                year : year,
            },
            success:function(data){
                  $("#table_body").css('display', 'none');
                 //  console.log(data[0]);
                  if(data.length == 0){
                     // console.log("I am here");
                      $("#table_body").css('display', 'block')
                      $("#table_body").html('<tr > <td style="width:100%; border:none;"><div style="text-align: center;">No data found </div></td> </tr>');
                  }else{
                      $("#table_body").css('display', '')
                      $("#table_body").html(data);
                  }

            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
          });

    }else{
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            url : '../sort-by-both',
            data:{
                year : year,
                month: month,
            },
            success:function(data){
                  $("#table_body").css('display', 'none');
                 //  console.log(data[0]);
                  if(data.length == 0){
                     // console.log("I am here");
                      $("#table_body").css('display', 'block')
                      $("#table_body").html('<tr > <td style="width:100%; border:none;"><div style="text-align: center;">No data found </div></td> </tr>');
                  }else{
                      $("#table_body").css('display', '')
                      $("#table_body").html(data);
                  }

            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
          });

    }


}




// document.getElementById("select_year").addEventListener("change", function(){
//     console.log(document.getElementById("select_year").value);
// })
