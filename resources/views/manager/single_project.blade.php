@extends('layouts.manager_layout')

@section("links")
<link rel="stylesheet" href="{{ asset("dev-assets/css/tag.input.css") }}">
<link rel="stylesheet" href="{{ asset("dev-assets/css/single_project.css") }}">
<script src="https://cdn.tiny.cloud/1/30h4n7mvg0u2p41o4jsx8y4fb4ev21mqq6j8xbs3nmbgf236/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                                                                <h3 id="tdg_project_name" class="card-label" data-ivalue="{{ $project->id }}"> {{  $project->name }}
                                                                <small>sub title</small></h3>
                                                            </div>
                                                            <div class="card-toolbar">
                                                                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                                                    <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="ki ki-bold-more-hor"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
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
                                                        <div class="card-body">{{ $project->description }}</div>
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
                                                            <div class="col-md-6">
                                                                <!--begin::List Widget 4-->
                                                                <div class="card card-custom card-stretch gutter-b">
                                                                    <!--begin::Header-->
                                                                    <div class="card-header border-0">
                                                                        <h3 class="card-title font-weight-bolder text-dark">Tasks</h3>
                                                                        <div class="card-toolbar" id="create_task">
                                                                                <a href="#" class="btn btn-light btn-sm font-size-sm font-weight-bolder  text-dark-75"  > <i class="fas fa-plus"></i>  Create</a>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Header-->
                                                                    <!--begin::Body-->
                                                                    <div class="card-body pt-2" id="task_board">
                                                                    @if($tasks)
                                                                        @foreach ( $tasks as $items )
                                                                            <div class="d-flex align-items-center mt-3">
                                                                                                        <!--begin::Bullet-->
                                                                                                    <span class="bullet bullet-bar bg-success align-self-stretch"></span>
                                                                                                    <!--end::Bullet-->
                                                                                                    <!--begin::Checkbox-->
                                                                                                    <label class="checkbox checkbox-lg checkbox-light-success checkbox-inline flex-shrink-0 m-0 mx-4">
                                                                                                        <input type="checkbox" name="select" value="1" onchange="stageChange(event,{{ $items->id}})"
                                                                                                        @if( $items->stage == "true")
                                                                                                            checked
                                                                                                        @endif
                                                                                                        >
                                                                                                        <span></span>
                                                                                                    </label>
                                                                                                    <!--end::Checkbox-->
                                                                                                    <!--begin::Text-->
                                                                                                    <div class="d-flex flex-column flex-grow-1" ondblclick="updateTask(event,{{ $items->id }})">
                                                                                                        <div class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1" id="tasklabel{{ $items->id }}" style="margin-top:4px; height:20px;
                                                                                                        @if( $items->stage == "true")
                                                                                                            text-decoration : line-through;
                                                                                                        @endif
                                                                                                            ">{{ $items->task }}</div>
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
                                                                                                                    <a href="#" class="navi-link">
                                                                                                                        <span class="navi-text">
                                                                                                                            Delete Task
                                                                                                                        </span>
                                                                                                                    </a>
                                                                                                                </li>
                                                                                                            </ul>
                                                                                                            <!--end::Navigation-->
                                                                                                        </div>
                                                                                                    </div>

                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                    </div>
                                                                    <!--end::Body-->
                                                                </div>
                                                                <!--end:List Widget 4-->
                                                            </div>
                                                            <div class="col-md-6">
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
                                                            </div>

                                                        </div>
                                                    </div>


                                        {{-- this is overview page  --}}

                                        </div>
                                        <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                                                {{-- this is role page starts --}}
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    <div class="card card-custom card-stretch gutter-b">
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
                                                    @foreach ($user as $item )
                                                    <div class="col-md-4">
                                                    <div class="card card-custom card-stretch gutter-b">
                                                        <!--begin::Body-->
                                                        <div class="card-body d-flex align-items-center py-0 mt-8">
                                                            <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                                                <a href="#" class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{ $item->name }}</a>
                                                                <span class="font-weight-bold text-muted font-size-lg">{{ $item->position }}</span>
                                                            </div>
                                                            <img src="assets/media/svg/avatars/029-boy-11.svg" alt="" class="align-self-end h-100px" />
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                {{-- this is role page ends --}}
                                        </div>
                                        <div class="tab-pane fade" id="demo-1" role="tabpanel" aria-labelledby="contact-tab-1">
                                                This is a files
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
@endsection

@section("scripts")
<script src="{{ asset("dev-assets/js/create_subtask.js") }}"></script>
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
  <script src="{{ asset("dev-assets/js/typehead.js") }}"></script>

@endsection
