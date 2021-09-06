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
            <div class="row ">
                <div class="col-md-6 d-flex align-items-center">
                          <h1>My Tasks</h1>
                </div>

                <div class="col-md-6 d-flex justify-content-end">
                    <div>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                            <input type="radio" name="options" id="option1" checked onload="listview()" onclick="listview()"> List
                            </label>
                            <label class="btn btn-secondary">
                            <input type="radio" name="options" id="option2" onclick="boardview()"> Board
                            </label>
                        </div>
                    </div>
                </div>
           </div>
            <div class="board-layout" id="board_view" style="display:none;">
              <div id='boardlists' class="board-lists">
                <div id='list1' class="board-list" ondrop="dropIt(event)" data-value="Todo" ondragover="allowDrop(event)">
                  <div class="list-title">
                    To Do
                  </div>


                          {{-- ----------- Todo Card Starts---------------}}
                                @foreach ($record as $item )
                                      @if($item->status == "todo")
                                        <div  id='card' class="card text-white
                                             @if($item->priority == "low")
                                                bg-success
                                             @elseif ($item->priority == "medium")
                                                bg-warning
                                             @else
                                                bg-danger
                                             @endif

                                        "    data-target="#exampleModal" draggable="true" ondragstart="dragStart(event)">
                                             {{ $item->name }}
                                        </div>
                                      @endif
                                @endforeach


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
                        @foreach ($record as $item )
                        @if($item->status == "running")
                          <div  id='card' class="card text-white
                                             @if($item->priority == "low")
                                                bg-success
                                             @elseif ($item->priority == "medium")
                                                bg-warning
                                             @else
                                                bg-danger
                                             @endif


                          "    data-target="#exampleModal" draggable="true" ondragstart="dragStart(event)">
                              {{ $item->name  }}
                          </div>
                        @endif
                       @endforeach
                </div>
                <div  id='list3' class="board-list" data-value="Review"  ondrop="dropIt(event)" ondragover="allowDrop(event)">
                  <div  class="list-title">
                   Complete
                  </div>
                    @foreach ($record as $item )
                        @if($item->status == "complete")
                          <div  id='card' class="card text-white
                                             @if($item->priority == "low")
                                                bg-success
                                             @elseif ($item->priority == "medium")
                                                bg-warning
                                             @else
                                                bg-danger
                                             @endif


                          "    data-target="#exampleModal" draggable="true" ondragstart="dragStart(event)">
                            {{ $item->name  }}
                          </div>
                        @endif
                       @endforeach
                </div>
                <div  id='list4' class="board-list" data-value="Done"  ondrop="dropIt(event)" ondragover="allowDrop(event)">
                    <div  class="list-title">
                     Stopped
                    </div>
                    @foreach ($record as $item )
                        @if($item->status == "stopped")
                          <div  id='card' class="card text-white
                                            @if($item->priority == "low")
                                                bg-success
                                             @elseif ($item->priority == "medium")
                                                bg-warning
                                             @else
                                                bg-danger
                                             @endif


                          "    data-target="#exampleModal" draggable="true" ondragstart="dragStart(event)">
                              {{ $item->name  }}
                          </div>
                        @endif
                       @endforeach
                </div>
              </div>
            </div>

            <div id="list_view">

            </div>

         </div>
    </div>

</div>
@endsection

@section("scripts")
   <script src="{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.js") }}"></script>
   <script src="{{ asset("assets/js/pages/widgets.js") }}"></script>
   <script src="{{ asset("dev-assets/js/broad.js") }}"></script>
   <script src="{{ asset("dev-assets/js/sort_project.js") }}"></script>
@endsection
