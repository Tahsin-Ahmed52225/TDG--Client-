@extends('layouts.manager_layout')

@section("links")
<link rel="stylesheet" href="{{ asset("dev-assets/css/tag.input.css") }}">
<link rel="stylesheet" href="{{ asset("dev-assets/css/single_project.css") }}">
<script src="https://cdn.tiny.cloud/1/30h4n7mvg0u2p41o4jsx8y4fb4ev21mqq6j8xbs3nmbgf236/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- filepond CSS --}}
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection

@section("content")
<div class="content d-flex flex-column flex-column-fluid " id="kt_content" style="padding-top: 0px;" >
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="flash-message"></div>
            <div class="row">
                <div class="col-8">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <!--begin::Example-->
                            <div class="example">
                                <div class="example-preview">
                                    <ul class="nav nav-pills" id="myTab1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab-1" data-toggle="tab" href="#home-1">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-chat-1"></i>
                                                </span>
                                                <span class="nav-text">Overview</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#profile-1" aria-controls="profile">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-layers-1"></i>
                                                </span>
                                                <span class="nav-text">Project Unit</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab-1" data-toggle="tab" href="#demo-1" aria-controls="contact">
                                                <span class="nav-icon">
                                                    <i class="flaticon2-rocket-1"></i>
                                                </span>
                                                <span class="nav-text">Files</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-5" id="myTabContent1">
                                        <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">

                                        {{-- this is overview page  --}}
                                        <div class="card card-custom">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <span class="card-icon">
                                                                    <i class="flaticon-graphic-2 text-primary"></i>
                                                                </span>

                                                                <div id="tdg_project_name" class="card-label h3" data-ivalue="{{ $project->id }}">
                                                                         {{  $project->project_name }}
                                                                </div>
                                                            </div>
                                                            <div class="card-toolbar">
                                                                <div class="dropdown dropdown-inline" >
                                                                    <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="ki ki-bold-more-hor"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                                                        <!--begin::Navigation-->
                                                                        <ul class="navi navi-hover">
                                                                            <li class="navi-header font-weight-bold py-4">
                                                                                <span class="font-size-lg">Quick Action</span>
                                                                                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Project Quick Actions"></i>
                                                                            </li>
                                                                            <li class="navi-separator mb-3 opacity-70"></li>
                                                                            <li class="navi-item">
                                                                                <a href="#" class="navi-link">
                                                                                    <span class="navi-text">
                                                                                        <span class="label label-xl label-inline label-light-info" > Project Details</span>
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
                                                                        </ul>
                                                                        <!--end::Navigation-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="tdg_project_description" class="card-body" data-ivalue="{{ $project->id }}">
                                                            {{ $project->description }}
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <!--begin::Tiles Widget 7-->
                                                                <div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-color: #1B283F; background-position: 0 calc(100% + 0.5rem); background-size: 100% auto; background-image: url(assets/media/svg/patterns/rhone.svg)">
                                                                    <!--begin::Body-->
                                                                    <div class="card-body">
                                                                        <div class="p-4">
                                                                            <h3 class="text-white font-weight-bolder my-7">Create CRM Reports</h3>
                                                                            <a href='#' class="btn btn-danger font-weight-bold px-6 py-3">Create Report</a>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Body-->
                                                                </div>
                                                                <!--end::Tiles Widget 7-->
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <!--begin::Tiles Widget 7-->
                                                                <div class="card card-custom bgi-no-repeat gutter-b card-stretch" style="background-color: #ffffff; background-position: 0 calc(100% + 0.5rem); background-size: 100% auto;">
                                                                    <!--begin::Body-->
                                                                    <div class="card-body">
                                                                        <div class="p-4">
                                                                            <h3 class="text-success font-weight-bolder my-7">Create CRM Reports</h3>
                                                                            <a href='#' class="btn btn-danger font-weight-bold px-6 py-3">Create Report</a>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Body-->
                                                                </div>
                                                                <!--end::Tiles Widget 7-->
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <!--begin::List Widget 4-->
                                                                <div class="card card-custom card-stretch gutter-b">
                                                                    <!--begin::Header-->
                                                                    <div class="card-header border-0">
                                                                        <h3 class="card-title font-weight-bolder text-dark" >Tasks</h3>
                                                                        <div class="card-toolbar" id="create_task">
                                                                                <a href="#" class="btn btn-light btn-sm font-size-sm font-weight-bolder  text-dark-75"  > <i class="fas fa-plus"></i>  Create</a>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Header-->
                                                                    <!--begin::Body-->
                                                                    <div class="card-body pt-2" id="task_board">
                                                                    @if($tasks)
                                                                        @foreach ( $tasks as $items )
                                                                            <div class="d-flex align-items-center mt-3" id="task{{ $items->id }}">
                                                                                                        <!--begin::Bullet-->
                                                                                                    <span class="bullet bullet-bar bg-success align-self-stretch"></span>
                                                                                                    <!--end::Bullet-->
                                                                                                    <!--begin::Checkbox-->
                                                                                                    <label class="checkbox checkbox-lg checkbox-light-success checkbox-inline flex-shrink-0 m-0 mx-4"  >
                                                                                                        <input type="checkbox" name="select" data-id={{ $items->id}} class="task_checkbox"  {{ $items->complete == 1 ? 'checked' : '' }}>
                                                                                                        <span></span>
                                                                                                    </label>
                                                                                                    <!--end::Checkbox-->
                                                                                                    <!--begin::Text-->
                                                                                                    <div class="d-flex flex-column flex-grow-1" data-toggle="modal" data-target="#exampleModal{{ $items->id }}" style="cursor: pointer;">
                                                                                                        <div class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1 sub_task_title" id="taskname{{ $items->id }}" data-id={{ $items->id}}  style="margin-top:4px; height:20px;
                                                                                                            @if( $items->complete == 1)
                                                                                                                text-decoration: line-through;
                                                                                                            @endif">{{ $items->Name }}</div>
                                                                                                    </div>
                                                                                                    <!--end::Text-->
                                                                                                    <!--begin::Dropdown-->
                                                                                                    <div class="dropdown dropdown-inline ml-2">
                                                                                                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                            <i class="ki ki-bold-more-hor"></i>
                                                                                                        </a>
                                                                                                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                                                                                            <!--begin::Navigation-->
                                                                                                            <ul class="navi navi-hover">
                                                                                                                <li class="navi-item bg-light-danger rounded">
                                                                                                                        <a  class="sub_task_delete navi-link" data-id={{ $items->id}}>
                                                                                                                            <span class="navi-text" >
                                                                                                                                Delete Task
                                                                                                                            </span>
                                                                                                                        </a>
                                                                                                                </li>
                                                                                                            </ul>
                                                                                                            <!--end::Navigation-->
                                                                                                        </div>
                                                                                                    </div>

                                                                              </div>
                                                                              {{-- sub task details starts --}}
                                                                              <!-- Button trigger modal -->
                                                                                <!-- Modal -->
                                                                                <div class="modal fade" id="exampleModal{{ $items->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel" data-id={{ $items->id }} style="width:90%">{{ $items->Name }}</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true" style="display:block;">&times;</span>
                                                                                        </button>
                                                                                        </div>

                                                                                        <div class="modal-body">
                                                                                            <div id="subtask_description{{ $items->id }}"  class="{{  $items->Description == null ? 'nulled_task' : 'Sub_task_description' }} sub_task_description" data-ivalue={{  $items->id }}>
                                                                                                {{  $items->Description == null ? '@Double Tap To Add Description' : $items->Description }}
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="modal-footer" style="display:block">
                                                                                            <div style="font-size:12px">Members:</div>
                                                                                            <i style="font-size: 25px;" class="far fa-user-circle"></i>
                                                                                            <div class="dropdown">
                                                                                                <i class=" flaticon-add-circular-button dropdown-toggle" style="font-size: 25px;"  role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" ></i>
                                                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                                                                    </ul>
                                                                                            </div>



                                                                                        </div>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                              {{-- sub task details ends --}}
                                                                        @endforeach
                                                                    @endif
                                                                    </div>
                                                                    <!--end::Body-->

                                                                </div>
                                                                <!--end:List Widget 4-->
                                                            </div>
                                                            {{-- <div class="col-md-6">
                                                                <div class="card card-custom card-stretch gutter-b">
                                                                    <!--begin::Header-->
                                                                    <div class="card-header align-items-center border-0 mt-4">
                                                                        <h3 class="card-title align-items-start flex-column">
                                                                            <span class="font-weight-bolder text-dark">My Activity</span>
                                                                            <span class="text-muted mt-3 font-weight-bold font-size-sm">890,344 Sales</span>
                                                                        </h3>
                                                                        <div class="card-toolbar">
                                                                            <div class="dropdown dropdown-inline">
                                                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    <i class="ki ki-bold-more-hor"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
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
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Header-->
                                                                    <!--begin::Body-->
                                                                    <div class="card-body pt-4">
                                                                        <!--begin::Timeline-->
                                                                        <div class="timeline timeline-6 mt-3">
                                                                            <!--begin::Item-->
                                                                            <div class="timeline-item align-items-start">
                                                                                <!--begin::Label-->
                                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">08:42</div>
                                                                                <!--end::Label-->
                                                                                <!--begin::Badge-->
                                                                                <div class="timeline-badge">
                                                                                    <i class="fa fa-genderless text-warning icon-xl"></i>
                                                                                </div>
                                                                                <!--end::Badge-->
                                                                                <!--begin::Text-->
                                                                                <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">Outlines keep you honest. And keep structure</div>
                                                                                <!--end::Text-->
                                                                            </div>
                                                                            <!--end::Item-->
                                                                            <!--begin::Item-->
                                                                            <div class="timeline-item align-items-start">
                                                                                <!--begin::Label-->
                                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">10:00</div>
                                                                                <!--end::Label-->
                                                                                <!--begin::Badge-->
                                                                                <div class="timeline-badge">
                                                                                    <i class="fa fa-genderless text-success icon-xl"></i>
                                                                                </div>
                                                                                <!--end::Badge-->
                                                                                <!--begin::Content-->
                                                                                <div class="timeline-content d-flex">
                                                                                    <span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">AEOL meeting</span>
                                                                                </div>
                                                                                <!--end::Content-->
                                                                            </div>
                                                                            <!--end::Item-->
                                                                            <!--begin::Item-->
                                                                            <div class="timeline-item align-items-start">
                                                                                <!--begin::Label-->
                                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">14:37</div>
                                                                                <!--end::Label-->
                                                                                <!--begin::Badge-->
                                                                                <div class="timeline-badge">
                                                                                    <i class="fa fa-genderless text-danger icon-xl"></i>
                                                                                </div>
                                                                                <!--end::Badge-->
                                                                                <!--begin::Desc-->
                                                                                <div class="timeline-content font-weight-bolder font-size-lg text-dark-75 pl-3">Make deposit
                                                                                <a href="#" class="text-primary">USD 700</a>. to ESL</div>
                                                                                <!--end::Desc-->
                                                                            </div>
                                                                            <!--end::Item-->
                                                                            <!--begin::Item-->
                                                                            <div class="timeline-item align-items-start">
                                                                                <!--begin::Label-->
                                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">16:50</div>
                                                                                <!--end::Label-->
                                                                                <!--begin::Badge-->
                                                                                <div class="timeline-badge">
                                                                                    <i class="fa fa-genderless text-primary icon-xl"></i>
                                                                                </div>
                                                                                <!--end::Badge-->
                                                                                <!--begin::Text-->
                                                                                <div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3">Indulging in poorly driving and keep structure keep great</div>
                                                                                <!--end::Text-->
                                                                            </div>
                                                                            <!--end::Item-->
                                                                            <!--begin::Item-->
                                                                            <div class="timeline-item align-items-start">
                                                                                <!--begin::Label-->
                                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">21:03</div>
                                                                                <!--end::Label-->
                                                                                <!--begin::Badge-->
                                                                                <div class="timeline-badge">
                                                                                    <i class="fa fa-genderless text-danger icon-xl"></i>
                                                                                </div>
                                                                                <!--end::Badge-->
                                                                                <!--begin::Desc-->
                                                                                <div class="timeline-content font-weight-bolder text-dark-75 pl-3 font-size-lg">New order placed
                                                                                <a href="#" class="text-primary">#XF-2356</a>.</div>
                                                                                <!--end::Desc-->
                                                                            </div>
                                                                            <!--end::Item-->
                                                                            <!--begin::Item-->
                                                                            <div class="timeline-item align-items-start">
                                                                                <!--begin::Label-->
                                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">23:07</div>
                                                                                <!--end::Label-->
                                                                                <!--begin::Badge-->
                                                                                <div class="timeline-badge">
                                                                                    <i class="fa fa-genderless text-info icon-xl"></i>
                                                                                </div>
                                                                                <!--end::Badge-->
                                                                                <!--begin::Text-->
                                                                                <div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3">Outlines keep and you honest. Indulging in poorly driving</div>
                                                                                <!--end::Text-->
                                                                            </div>
                                                                            <!--end::Item-->
                                                                            <!--begin::Item-->
                                                                            <div class="timeline-item align-items-start">
                                                                                <!--begin::Label-->
                                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">16:50</div>
                                                                                <!--end::Label-->
                                                                                <!--begin::Badge-->
                                                                                <div class="timeline-badge">
                                                                                    <i class="fa fa-genderless text-primary icon-xl"></i>
                                                                                </div>
                                                                                <!--end::Badge-->
                                                                                <!--begin::Text-->
                                                                                <div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3">Indulging in poorly driving and keep structure keep great</div>
                                                                                <!--end::Text-->
                                                                            </div>
                                                                            <!--end::Item-->
                                                                            <!--begin::Item-->
                                                                            <div class="timeline-item align-items-start">
                                                                                <!--begin::Label-->
                                                                                <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">21:03</div>
                                                                                <!--end::Label-->
                                                                                <!--begin::Badge-->
                                                                                <div class="timeline-badge">
                                                                                    <i class="fa fa-genderless text-danger icon-xl"></i>
                                                                                </div>
                                                                                <!--end::Badge-->
                                                                                <!--begin::Desc-->
                                                                                <div class="timeline-content font-weight-bolder font-size-lg text-dark-75 pl-3">New order placed
                                                                                <a href="#" class="text-primary">#XF-2356</a>.</div>
                                                                                <!--end::Desc-->
                                                                            </div>
                                                                            <!--end::Item-->
                                                                        </div>
                                                                        <!--end::Timeline-->
                                                                    </div>
                                                                    <!--end: Card Body-->
                                                                </div>
                                                            </div> --}}

                                                        </div>
                                                    </div>


                                        {{-- this is overview page  --}}

                                        </div>
                                        <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                                                {{-- this is role page starts --}}
                                                @if(!$project_manager)
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card  card-custom  gutter-b">
                                                                <div class="card-body ">
                                                                    <i class="fas fa-info-circle text-primary"></i>
                                                                     Project Manager Not Assigned. <a href="#" data-toggle="modal" data-target="#staticBackdrop">Assign Now?</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Project Manager assign modal starts  --}}

                                                    <!-- Button trigger modal-->
                                                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Assign Project Manager</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                                    <table class="table table-sm table-borderless text-center">
                                                                                        <tbody class="text-center">
                                                                                            @foreach ($employee as $item )
                                                                                            <tr>
                                                                                                <td class="text-left align-middle">{{ $item->name }}</td>
                                                                                                <td class="align-middle">{{ $item->position }}</td>
                                                                                                <td>
                                                                                                    <form method="POST" action="{{ route("manager.assign_project_manager", $project->id) }}">
                                                                                                    @csrf
                                                                                                        <button class="btn btn-sm btn-primary" type="submit" name="project_manager" value="{{ $item->id }}" >Assign</button>
                                                                                                    </form>

                                                                                                </td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Project Manager assign modal Ends  --}}
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-4"  >
                                                    <div class="card">
                                                        <!--begin::Body-->
                                                        <div class="card-body d-flex align-items-center justify-content-center">
                                                            <div class="row align-items-center justify-content-center pt-2" data-toggle="modal" data-target="#exampleModal">
                                                                <i class=" flaticon-add-circular-button mr-2" style="font-size:40px;"></i>
                                                                <a href="#" class="card-title font-size-h5  text-hover-primary text-muted mb-0">Add Role</a>
                                                            </div>

                                                        </div>
                                                        {{-- add role modal starts--}}
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
                                                                    </div>
                                                                    <form method="POST" action={{ route("manager.update_project_member", $project->id) }}>
                                                                    @csrf
                                                                        <div class="modal-body">
                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-12">
                                                                                    <input placeholder="Add member by name" type="text" data-role="tagsinput"  value="" name="tdg_assignee_member" class="form-control" >
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        {{-- add role modal ends--}}
                                                        <!--end::Body-->
                                                    </div>
                                                    </div>
                                                    @foreach ($employee as $item )
                                                        <div class="col-md-4" >
                                                            <div class="card card-custom card-stretch gutter-b">
                                                                <!--begin::Body-->
                                                                <div class="card-body d-flex align-items-center py-0 mt-8">
                                                                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                                                        <div class="row">
                                                                            <div class="col-md-10">
                                                                                <a href="#" class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary" data-toggle="modal" data-target="#employeeModal{{ $item->id }}">{{ $item->name }}</a>
                                                                            </div>
                                                                            @if($item->id == $project_manager)
                                                                                <div class="col-md-2">
                                                                                    <span style="cursor: pointer;" class="badge badge-primary" title="Project Manager">PM</span>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <span class="font-weight-bold text-muted font-size-lg">{{ $item->position }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <img src="assets/media/svg/avatars/029-boy-11.svg" alt="" class="align-self-end h-100px" />
                                                                </div>
                                                                <!--end::Body-->
                                                            </div>
                                                        </div>
                                                        {{-- view member modal starts here  --}}
                                                            <div class="modal fade" id="employeeModal{{ $item->id }}" tabindex="-1" aria-labelledby="employeeModal{{ $item->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">{{ $item->name }}</h5>
                                                                            <span class="font-weight-bold text-muted font-size-lg">{{ $item->position }}</span>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6 text-center">
                                                                                    <form method="POST" action="{{ route("manager.remove_member",$project->id) }}">
                                                                                    @csrf
                                                                                       <button type="submit" class="btn btn-lg btn-danger" name="member_id" value={{ $item->id }} @if($item->id == $project_manager) disabled @endif><i class="fas fa-minus-circle"></i> Remove Member</button>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="col-md-6 text-center">
                                                                                    @if($item->id == $project_manager)
                                                                                    <form method="POST" action="{{ route("manager.remove_p_manager",$project->id) }}">
                                                                                    @csrf
                                                                                        <button type="submit" name="member_id"  value={{ $item->id }} class="btn btn-lg btn-danger"><i class="fas fa-minus-circle"></i>  Remove P.Manager</button>
                                                                                    </form>

                                                                                    @elseif($project_manager == NULL)
                                                                                        <form method="POST" action="{{ route("manager.assign_project_manager",$project->id) }}">
                                                                                        @csrf
                                                                                            <button type="submit" name="project_manager" value="{{ $item->id }}" class="btn btn-lg btn-primary"><i class="fas fa-user-plus"></i>Make P.Manager</button>
                                                                                        </form>
                                                                                    @else
                                                                                        <form method="POST" action="{{ route("manager.assign_project_manager",$project->id) }}">
                                                                                            @csrf
                                                                                             <button type="submit" name="project_manager" value="{{ $item->id }}" class="btn btn-lg btn-info"><i class="fas fa-people-arrows"></i></i>Change P.Manager</button>
                                                                                        </form>
                                                                                    @endif

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {{-- view member modal ends here --}}
                                                    @endforeach
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4" >
                                                        <div class="card card-custom card-stretch gutter-b">
                                                            <!--begin::Body-->
                                                            <div class="card-body d-flex align-items-center py-0 mt-8 ">
                                                                <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                                                    <div class="row">
                                                                        <div class="col-md-10">
                                                                            <a href="#" class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ $client_details->name }}</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <span class="font-weight-bold text-muted font-size-lg">Client</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <img src="assets/media/svg/avatars/029-boy-11.svg" alt="" class="align-self-end h-100px" />
                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- this is role page ends --}}
                                        </div>
                                        <div class="tab-pane fade" id="demo-1" role="tabpanel" aria-labelledby="contact-tab-1">
                                            <div class="card card-custom gutter-b">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h3 class="card-label">
                                                            Project Files
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                            <input type="file" name="fileUpload"  />
                                                </div>
                                                <div class="card-footer">
                                                    {{-- <table class="table table-striped">
                                                        <tbody>
                                                            @php
                                                               $counter = 0;
                                                            @endphp
                                                            @foreach(json_decode($project->project_files) as $item)

                                                            <tr>
                                                                <td > Mahbubur Rahaman Uploaded <a class="ml-2" target="_blank" href="{{ asset('files/'.$project->id.'/'.$item) }}">{{ $item }}</a>  </td>
                                                                <td class="text-right"><i class="fas fa-trash-alt grow" data-toggle="modal" data-target="#staticBackdrop"></i></td>
                                                            </tr>

                                                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $counter }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                  <div class="modal-content">
                                                                    <div class="modal-header">
                                                                      <h5 class="modal-title" id="staticBackdropLabel{{ $counter }}"><i class="fas fa-exclamation-circle"></i> Warning</h5>
                                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                      </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                      Ary you sure you want to delete this file?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                      <form method="POST" action="{{ route("manager.delete_file",$project->id) }}">
                                                                        @csrf
                                                                        <button type="submit" name="file_index" value="{{ $counter }}" class="btn btn-danger">Delete</button>
                                                                      </form>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              @php
                                                                $counter++;
                                                              @endphp

                                                            @endforeach
                                                        </tbody>
                                                    </table> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">

                    <div class="card">
                        <div  id="" >
                            <style>
                                .tox-tinymce {
                                            height:200px !important;
                                        }
                            </style>
                                <div class="card card-custom">
                                <div class="card-header">
                                    <div class="card-title">
                                        <span class="card-icon">
                                            <i class="flaticon-graphic-2 text-primary"></i>
                                        </span>
                                        <h3 class="card-label"> Discusstion</h3>
                                    </div>

                                </div>
                                <div class="card-body" id="discussion_panel">
                                    <div class="card">
                                        <div class="card-body" id="message_panel"    @if($project->status == "complete") style="height: 70vh; overflow:hidden; @endif">
                                            <div class="g-0">

                                                <div>
                                                    <div class="position-relative">
                                                        <div class="chat-messages p-4">

                                                            <div class="chat-message-right pb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                    <div class="font-weight-bold mb-1">You</div>
                                                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-left pb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-right mb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:35 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                    <div class="font-weight-bold mb-1">You</div>
                                                                    Cum ea graeci tractatos.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-left pb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:36 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                                                    Sed pulvinar, massa vitae interdum pulvinar, risus lectus porttitor magna, vitae commodo lectus mauris et velit.
                                                                    Proin ultricies placerat imperdiet. Morbi varius quam ac venenatis tempus.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-left pb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:37 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                                                    Cras pulvinar, sapien id vehicula aliquet, diam velit elementum orci.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-right mb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:38 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                    <div class="font-weight-bold mb-1">You</div>
                                                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-left pb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:39 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-right mb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:40 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                    <div class="font-weight-bold mb-1">You</div>
                                                                    Cum ea graeci tractatos.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-right mb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:41 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                    <div class="font-weight-bold mb-1">You</div>
                                                                    Morbi finibus, lorem id placerat ullamcorper, nunc enim ultrices massa, id dignissim metus urna eget purus.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-left pb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:42 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                                                    Sed pulvinar, massa vitae interdum pulvinar, risus lectus porttitor magna, vitae commodo lectus mauris et velit.
                                                                    Proin ultricies placerat imperdiet. Morbi varius quam ac venenatis tempus.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-right mb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:43 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                    <div class="font-weight-bold mb-1">You</div>
                                                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                                                </div>
                                                            </div>

                                                            <div class="chat-message-left pb-4">
                                                                <div>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                                                    <div class="text-muted small text-nowrap mt-2">2:44 am</div>
                                                                </div>
                                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        @if($project->status == "complete")
                                          <div class="card bg-light" id="chat_closed_box">

                                                <span class="text-muted text-center"> Chat is closed</span>


                                          </div>
                                        @else
                                        <div id="message_box">
                                            <form method="POST" action="{{ route("manager.add_discussion" , $project->id) }}">
                                                @csrf
                                                    <textarea name="project_test">
                                                    </textarea>
                                                    <button class="btn btn-sm btn-primary mt-4">Send Message</button>
                                            </form>
                                        </div>
                                        @endif



                                </div>
                            </div>

                            {{-- this is the  start of dicusstion tab --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- Toaster Code Starts --}}

<div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
    <div id="liveToast" class="toast hide toast-success" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="height: 80px; width:450px;">
      <div class="toast-header">
        <strong class="mr-auto">Notifications</strong>

        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        Hello, world! This is a toast message.
      </div>
    </div>
  </div>
{{-- Toaster Code Ends --}}

@endsection

@section("scripts")
<script src="{{ asset("dev-assets/js/manager/update_project_info.js") }}"></script>
<script src="{{ asset("dev-assets/js/manager/subtask.js") }}"></script>

<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'lists advlist autolink  media    table  ',
      toolbar: ' bold italic alignleft aligncenter alignright alignjustify| bullist numlist | outdent indent |  table',
      toolbar_mode: 'floating',
      branding: false,
      icons: 'material',
      menubar: false,
      placeholder: 'Type here...',
      statusbar: false,
   });
  </script>

  <script src="{{ asset("dev-assets/js/tag2.input.js") }}"></script>
  <script src="{{ asset("js/typeahead-main.js") }}" ></script>
  <script src="{{ asset("dev-assets/js/manager/typehead.js") }}"></script>
  {{-- filepond JS --}}
  <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
  <script src="{{ asset("dev-assets/js/single_project_file_upload.js") }}"></script>
  <script src="//cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

@endsection
