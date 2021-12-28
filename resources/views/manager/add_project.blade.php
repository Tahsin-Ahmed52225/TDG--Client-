@extends('layouts.manager_layout')

@section("links")
<link rel="stylesheet" href="{{ asset("dev-assets/css/tag.input.css") }}">
<link rel="stylesheet" href="{{ asset("dev-assets/css/tooltip.css") }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top: 0px">
    <!--begin::Entry-->
    <div class="row">
        <div class="d-flex flex-column-fluid col-md-6">
            <!--begin::Container-->
            <div class="container">
                @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>


                            @if ($errors->has('email'))
                            @endif
                            </div>
                        @endforeach
                @endif

                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    @if($msg == 'success')
                                         <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>

                                    @else
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endif
                @endforeach
                <div class="card card-custom">
                    <div class="card-header">
                     <h3 class="card-title">
                       Add Projects
                     </h3>
                    </div>
                    <!--begin::Form-->
                    <form method="POST" action={{ route("manager.add_project") }} enctype="multipart/form-data"  autocomplete="off">
                    @csrf
                     <div class="card-body">
                         <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="tdg_project_name"/>
                            </div>

                         </div>
                         <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Assignee <span class="text-danger">*</span></label>
                                <input  type="text" data-role="tagsinput" class="form-control" value="" name="tdg_assignee_member" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>Due Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tdg_project_date"/>
                            </div>

                         </div>
                         <div class="form-row">
                            <div class="form-group col-md-6">
                                <style>

                                </style>
                                <label for="exampleSelect1">Status <span class="text-danger">*</span></label>
                                <select class="form-control"  name="tdg_project_status">
                                    <option value="todo" class="text-dark font-weight-bold">Todo</option>
                                    <option value="running" class="text-info font-weight-bold">Running</option>
                                    <option value="complete" class="text-success font-weight-bold">Complete</option>
                                    <option value="stopped" class="text-danger font-weight-bold">Stopped</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Priority<span class="text-danger">*</span></label>
                                <select class="form-control"  name="tdg_project_priority" >
                                    <option value="high" class="text-danger font-weight-bold">  High</option>
                                    <option value="medium"  class="text-warning font-weight-bold">Medium</option>
                                    <option value="low" class="text-success font-weight-bold">Low</option>
                                </select>
                            </div>
                         </div>
                         <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Project Budget <span class="text-danger">*</span></label>
                                <input type="number"  class="form-control" name="tdg_project_budget">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Project Client<span class="text-danger">*</span></label>
                                <input  type="text" id="client" class="form-control" value="" name="tdg_client_ID" >
                            </div>
                         </div>


                        <div class="form-group">
                            <div class="form-group mb-1">
                                <label for="exampleTextarea">Description
                                <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="3" name="tdg_project_description"></textarea>
                            </div>
                        </div>

                      <div class="form-group ">
                            <input type="file" class="form-control" name="photos[]" multiple  style="height: calc(1.5em + 1.5rem + 5px);"/>
                      </div>



                     </div>
                     <div class="card-footer">
                            <button type="submit" id="submit_button" class="dropzone-upload btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                     </div>
                    </form>
                    <!--end::Form-->
                   </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid col-md-6">

            <!--begin::Container-->
            <div class="container">
                @foreach (['delete_msg', 'undoed'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        @if($msg == 'delete_msg')
                            <p class="alert alert-info">{{ Session::get('alert-' . $msg) }} <button class="btn btn-info btn-sm "><a class="text-white" href="{{ route("manager.undo_Project", Session::get('id_value')) }}">Undo</a></button> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @elseif($msg == 'undoed')
                        <p class="alert alert-success">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endif
                @endforeach
                <div class="card card-custom">
                    <div class="card-header">
                         <div class="card-title">
                             <h3 >
                                Recent Projects
                            </h3>
                         </div>

                        <div class="card-title">
                            <a href="{{ route("manager.view_project") }}">
                                  <button type="button" class="btn btn-primary btn-sm">View All</button>
                            </a>
                        </div>
                    </div>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ( $record as $item)

                    <a href="{{ route("manager.single_project", $item->id) }}">
                        <div class="card-body">
                            <div class="card card-custom text-dark">
                                <div class="priority
                                    @if($item->priority == "high")
                                        bg-danger

                                    @elseif($item->priority == "medium")
                                        bg-warning
                                    @elseif($item->priority == "low")
                                        bg-success
                                    @endif
                            "></div>
                                <div class="card-header" >

                                    <div class="card-title">
                                        <span class="card-icon">
                                            <i class="flaticon-graphic-2 "></i>
                                        </span>
                                        <h3 class="card-label">{{ $item->name }} </h3>
                                        @if($item->status == "complete")
                                            <span >
                                                <i class="far fa-check-circle text-success" style="font-size: 20px;"></i>
                                            </span>
                                        @else
                                            <span class="badge rounded-pill
                                            @if( $item->status == 'running')
                                                bg-info
                                            @elseif( $item->status == 'todo')
                                                bg-warning
                                            @else
                                                bg-danger
                                            @endif
                                            text-white" style="font-size:10px">{{ $item->status }}
                                            </span>
                                        @endif

                                    </div>
                                    <div class="card-toolbar">
                                        <div class="pr-2">
                                            <b>Due Date :</b>  {{Carbon\Carbon::parse($record[$i]->due_date)->format('d-m-Y') }}
                                        </div>
                                        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">

                                            <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </a>
                                            <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                                <!--begin::Navigation-->
                                                <ul class="navi navi-hover ">
                                                    <li class="navi-header font-weight-bold py-4">
                                                        <span class="font-size-lg">Quick Action:</span>
                                                        <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                                    </li>
                                                    <li class="navi-separator mb-3 opacity-70"></li>
                                                    @if($item->status != "complete")
                                                        <li class="navi-item">
                                                            <a href="{{ route("manager.mark_Complete" , $item->id) }}" class="navi-link">
                                                                <span class="navi-text">
                                                                    <span class="label label-xl label-inline label-light-success">Mark As Complete</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                <span class="label label-xl label-inline label-light-warning">Archive</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="{{ route("manager.delete_project" , $record[$i]->id) }}" class="navi-link">
                                                            <span class="navi-text">
                                                                <span class="label label-xl label-inline label-light-danger">Delete Project</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!--end::Navigation-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $item->description }}
                                </div>
                                <div class="card-footer" style="border: none;">
                                    <div class="row">
                                        <div class=" col-md-6">

                                            @foreach ( $user[$i] as $member[$i] )
                                            <span class="tool" data-tip="{{ $member[$i]->name }} | {{ $member[$i]->position }}">
                                                <i style="font-size: 25px;" class="far fa-user-circle"></i>
                                            </span>
                                            @endforeach
                                        </div>
                                        <div class="col-md-6" >
                                        <div class="d-flex justify-content-end align-item-center attachments">
                                            <div class="btn-group dropup">
                                                <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Attachments
                                                </button>
                                                <div class="dropdown-menu">
                                                    @foreach(json_decode($record[$i]->project_files) as $items )

                                                    <a class="dropdown-item" target="_blank" href="{{ asset('files/'.$item->id.'/'.$items) }}">{{ $items }}</a>

                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @php
                        $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section("scripts")
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> --}}
<script src="{{ asset("dev-assets/js/tag.input.js") }}"></script>
<script src="{{ asset("js/typeahead-main.js") }}" ></script>
<script src="{{ asset("dev-assets/js/typehead.js") }}"></script>



{{-- <script src="{{ asset("dev-assets/js/add_project.js") }}"></script> --}}


@endsection
