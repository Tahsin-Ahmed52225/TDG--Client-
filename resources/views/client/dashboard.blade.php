@extends('layouts.client_layout')
@section("links")
<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.css") }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
@endsection
@section('content')
<div class="container  " style="min-height: 80vh">
    <div class="row">

            <div class="col-lg-3">
                <!--begin::Card-->
                <a href="{{ route("client.view_projects", "running") }}">
                    <div class="card card-custom card-stretch bg-primary text-white">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label text-white">Running Project </h3>
                            </div>
                        </div>
                        <div class="card-body">
                        <h3>{{ $running_projects }}</h3>
                        </div>
                    </div>
               </a>
                <!--end::Card-->
            </div>

        <div class="col-lg-3">
            <!--begin::Card-->
            <a href="{{ route("client.view_projects", "complete") }}">
                <div class="card card-custom card-stretch bg-success text-white">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label text-white">Complete Project</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3>{{ $complete_projects }}</h3>
                    </div>
                </div>
            </a>
            <!--end::Card-->
        </div>
        <div class="col-lg-3">
            <!--begin::Card-->
            <a href="{{ route("client.view_projects", "stopped") }}">
                <div class="card card-custom card-stretch bg-warning text-white">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label text-white">On hold </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3>{{ $on_hold }}</h3>
                    </div>
                </div>
            </a>
            <!--end::Card-->
        </div>
        <div class="col-lg-3">
            <!--begin::Card-->
            <div class="card card-custom card-stretch">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Card Title <small>same height cards</small></h3>
                    </div>
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>


</div>



@endsection

@section("scripts")
   <script src="{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.js") }}"></script>
   <script src="{{ asset("assets/js/pages/widgets.js") }}"></script>
@endsection
