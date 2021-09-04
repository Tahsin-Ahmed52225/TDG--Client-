@extends('layouts.employee_layout')
@section("links")
<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.css") }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{  asset("dev-assets/css/broad.css")  }}">
<!--end::Page Vendors Styles-->
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top: 0px">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="board-layout">

                <div class="left">
                  <div class="board-text">My Tasks</div>
                </div>
            {{-- ----------------------------------TODO Board Start ----------------------------------------}}

              <div id='boardlists' class="board-lists">
                <div id='list1' class="board-list" ondrop="dropIt(event)" data-value="Todo" ondragover="allowDrop(event)">
                  <div class="list-title">
                    To Do
                  </div>


                          {{-- ----------- Todo Card Starts---------------}}

                                    <div  id='card' class="card bg-warning"    data-target="#exampleModal" draggable="true" ondragstart="dragStart(event)">
                                       Hello
                                    </div>

            {{-- <script>
                var values;
                var lists;

                function new_value_list(box) {
                        lists = box;
                }
                function add_list(data_id){
                    var node_id = data_id;

                    console.log(node_id);
                    console.log(lists);

                    $.ajax({
                        type: 'GET',
                        url: '{{ route("tdg.addlist") }}',
                        data: {
                            'idl': node_id,
                            'list_body': lists,
                        },
                        success: function (data) {

                     //Have some work here
                             console.log("succeed");

                        },
                        error: function (errorThrown) {

                            console.log("Error:".errorThrown);

                        },
                    })
                }
                function new_value(box) {
                        values = box;
                }
                function addcheck(data_id) {
                    console.log(data_id);
                    console.log(values);

                    $.ajax({
                        type: 'GET',
                        url: '{{ route("tdg.addnode") }}',
                        data: {
                            'idm': data_id,
                            'node_name': values
                        },
                        success: function (data) {

                     //Have some work here

                        },

                        error: function (errorThrown) {

                            console.log("Error:".errorThrown);

                        },
                    })


                }
            </script>
                       --}}

                </div>
              {{-- ----------------------------------TODO Board Ends ----------------------------------------}}

              {{-- ----------------------------------In progress Board Starts ----------------------------------------}}
                <div  id='list2' class="board-list" data-value="In Progress" ondrop="dropIt(event)" ondragover="allowDrop(event)">
                  <div  class="list-title">
                  Running
                  </div>
                        {{-- ----------------------------------In progress Card Starts ----------------------------------------}}
                        <div  id='card' class="card bg-warning"    data-target="#exampleModal" draggable="true" ondragstart="dragStart(event)">
                            Hello
                         </div>










                </div>
                <div  id='list3' class="board-list" data-value="Review"  ondrop="dropIt(event)" ondragover="allowDrop(event)">
                  <div  class="list-title">
                   Complete
                  </div>















                    </div>
                <div  id='list4' class="board-list" data-value="Done"  ondrop="dropIt(event)" ondragover="allowDrop(event)">
                    <div  class="list-title">
                     Stopped
                    </div>
                </div>
              </div>
            </div>

         </div>
    </div>

</div>
@endsection

@section("scripts")
   <script src="{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.js") }}"></script>
   <script src="{{ asset("assets/js/pages/widgets.js") }}"></script>
   <script src="{{ asset("dev-assets/js/broad.js") }}"></script>
@endsection
