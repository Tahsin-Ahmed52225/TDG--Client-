@extends('layouts.employee_layout')
@section("links")
<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.css") }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset("dev-assets/css/tooltip.css") }}">
<link rel="stylesheet" href="{{  asset("dev-assets/css/broad.css")  }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            <div class="board-layout" id="board_view" >
              <div id='boardlists' class="board-lists">
                <div id='list1' class="board-list" ondrop="dropIt(event)" data-value="todo" ondragover="allowDrop(event)">
                  <div class="list-title">
                    To Do
                  </div>

                          {{-- ----------- Todo Card Starts---------------}}
                                @foreach ($record as $item )
                                      @if($item->status == "todo")
                                      <a href="{{ route('employee.single_project' ,$item->id) }}">
                                        <div  id='card @php echo $item->id; @endphp' class="card text-white
                                             @if($item->priority == "low")
                                                bg-success
                                             @elseif ($item->priority == "medium")
                                                bg-warning
                                             @else
                                                bg-danger
                                             @endif

                                        "    data-target="#exampleModal" data-id= "{{ $item->id  }}" draggable="true" ondragstart="dragStart(event)">
                                             {{ $item->name }}
                                      </a>
                                        </div>
                                      @endif
                                @endforeach

                </div>
              {{-- ----------------------------------TODO Board Ends ----------------------------------------}}

              {{-- ----------------------------------In progress Board Starts ----------------------------------------}}
                <div  id='list2' class="board-list" data-value="running" ondrop="dropIt(event)" ondragover="allowDrop(event)">
                  <div  class="list-title">
                  Running
                  </div>
                        {{-- ----------------------------------In progress Card Starts ----------------------------------------}}
                        @foreach ($record as $item )
                        @if($item->status == "running")
                        <a href="{{ route('employee.single_project' ,$item->id) }}">
                          <div  id='card' class="card text-white
                                             @if($item->priority == "low")
                                                bg-success
                                             @elseif ($item->priority == "medium")
                                                bg-warning
                                             @else
                                                bg-danger
                                             @endif


                          "    data-target="#exampleModal" data-id= "{{ $item->id  }}" draggable="true" ondragstart="dragStart(event)">
                           {{ $item->name  }}
                          </div>
                        </a>
                        @endif
                       @endforeach
                </div>
                <div  id='list3' class="board-list" data-value="complete"  ondrop="dropIt(event)" ondragover="allowDrop(event)">
                  <div  class="list-title">
                   Complete
                  </div>
                    @foreach ($record as $item )
                        @if($item->status == "complete")
                        <a href="{{ route('employee.single_project' ,$item->id) }}">
                          <div  id='card @php echo $item->id; @endphp' class="card text-white
                                             @if($item->priority == "low")
                                                bg-success
                                             @elseif ($item->priority == "medium")
                                                bg-warning
                                             @else
                                                bg-danger
                                             @endif


                          "    data-target="#exampleModal" data-id= "{{ $item->id }}" draggable="true" ondragstart="dragStart(event)">
                            {{ $item->name  }}
                          </div>
                        </a>
                        @endif
                       @endforeach
                </div>
                <div  id='list4' class="board-list" data-value="stopped"  ondrop="dropIt(event)" ondragover="allowDrop(event)">
                    <div  class="list-title">
                     Stopped
                    </div>
                    @foreach ($record as $item )
                        @if($item->status == "stopped")
                        <a href="{{ route('employee.single_project' ,$item->id) }}">
                          <div  id='card @php echo $item->id; @endphp' class="card text-white
                                            @if($item->priority == "low")
                                                bg-success
                                             @elseif ($item->priority == "medium")
                                                bg-warning
                                             @else
                                                bg-danger
                                             @endif


                          "    data-target="#exampleModal" data-id= "{{ $item->id }}" draggable="true" ondragstart="dragStart(event)">
                              {{ $item->name  }}
                          </div>
                        </a>
                        @endif
                       @endforeach
                </div>
              </div>
            </div>

            <div id="list_view">
                <div class="card card-custom gutter-b" id="error_holder">
                    <div class="card-header pt-5 mt-2" style="display:block;">
                       <div class="row">
                           <div class="col-md-4">
                               <div class="row ">
                                    <div class="col-md-4 pt-1 pr-2">
                                        <a href="{{ route("manager.add_project") }}">
                                        <button type="button" class="btn btn-light btn-sm"> <i class="fas fa-plus"></i> <span class="pt-2">Add New</span> </button>
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="searchBox" placeholder="Search" oninput="searchIT()" >
                                            </div>
                                    </div>

                               </div>

                           </div>
                           <div class="col-md-4">
                           </div>
                           <div class="col-md-2">
                            <select class="form-control" id="select_month" onchange="monthChange(this.e)" name="month">
                                <option value="none">Month</option>
                                <option value='01'>January</option>
                                <option value='02'>February</option>
                                <option value='03'>March</option>
                                <option value='04'>April</option>
                                <option value='05'>May</option>
                                <option value='06'>June</option>
                                <option value='07'>July</option>
                                <option value='08'>August</option>
                                <option value='09'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December  </option>
                              </select>
                           </div>
                           <div class="col-md-2">
                                <select class="form-control" id="select_year"  onchange="yearChange(this.e)" name="myear">
                                    <option value="none">Year</option>
                                    <option value='2021'>2021</option>
                                    <option value='2022'>2022</option>
                                    <option value='2023'>2023</option>
                                    <option value='2024'>2024</option>
                                </select>
                           </div>
                       </div>
                    </div>
                    <div class="card-body" style="overflow-X: scroll; padding: 0.5rem 2.25rem;">

                        <!--begin: Datatable-->
                       <table class="table table-bordered table-hover table-checkable text-left "  id="kt_datatable" >
                            <thead>
                                 <tr >

                                    <th style="width:50%; ">Project Name</th>
                                    <th>Assign Member</th>
                                    <th>Due Date</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                  </tr>

                            </thead>
                            <tbody id="table_body">
                                @php
                                    $i = 0;
                                @endphp
                                <style>
                                    .grow { transition: all .2s ease-in-out; }
                                    .grow:hover { transform: scale(1.5); }
                                </style>
                                @foreach ($record as $values )

                                                <tr id="row{{ $values->id }}" onclick="window.location='{{ route('employee.single_project' ,$values->id) }}';">
                                                    <td id="name{{ $values->id }}"  style="padding: 17px 10px !important; width:50%;">

                                                        @if($values->status == "complete")
                                                            <i class="fas fa-check-circle pr-2 text-success" style="font-size:20px"></i>
                                                        @else
                                                           <a href="{{ route("employee.mark_Complete" , $values->id) }}">
                                                               <i class="far fa-check-circle pr-2 grow" style="font-size:20px"></i>
                                                           </a>

                                                        @endif

                                                        {{ $values->name }}
                                                    </td>
                                                    <td id="email{{ $values->id }}" style="padding: 17px 10px !important;">

                                                        @foreach ( $user[$i] as $member[$i] )
                                                        <span class="tool" data-tip="{{ $member[$i]->name }} | {{ $member[$i]->position }}">
                                                            <i style="font-size: 25px;" class="far fa-user-circle"></i>
                                                        </span>
                                                        @endforeach

                                                    </td>
                                                    <td id="number{{ $values->id }}" style="padding: 17px 10px !important;">
                                                        {{Carbon\Carbon::parse($record[$i]->due_date)->format('d-m-Y') }}
                                                    </td>
                                                    <td  style="padding: 17px 10px !important;">
                                                    <div id="position{{ $values->id }}">
                                                            <span class="badge
                                                            @if($values->priority =="low")
                                                            badge-success
                                                            @elseif($values->priority =="medium")
                                                            badge-warning
                                                            @else
                                                            badge-danger
                                                            @endif
                                                            "> {{ $values->priority }}</span>
                                                    </div>
                                                    </td>
                                                    <td id="stage_board{{$values->id}}" style="padding: 17px 5px !important;">
                                                        <span class="badge
                                                        @if($values->status =="complete")
                                                        badge-success
                                                        @elseif($values->status =="running")
                                                        badge-info
                                                        @elseif($values->status =="todo")
                                                        badge-warning
                                                        @else
                                                        badge-danger
                                                        @endif">
                                                            {{ $values->status }}
                                                        </span>

                                                    </td>
                                                </tr>

                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable-->
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
   <script src="{{ asset("dev-assets/js/sort_project.js") }}"></script>
@endsection
