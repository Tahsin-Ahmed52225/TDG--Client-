@extends('layouts.client_layout')
@section("links")
<!--begin::Page Vendors Styles(used by this page)-->

<!--end::Page Vendors Styles-->
@endsection
@section('content')
<div class="container " style="min-height: 80vh">
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ ucfirst(trans($stage))  }} Projects</h5>
                    <!--end::Page Title-->

                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <div class="form-group">
                        <label>Left Icon Input</label>
                        <div class="input-icon">
                         <input type="text" class="form-control" placeholder="Search..."/>
                         <span><i class="flaticon2-search-1 icon-md"></i></span>
                        </div>
                    </div>
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->

    </div>
    <!--end::Content-->
     <div class="row">
       @if(count($projects)>0)
         @foreach ($projects as $items)

                <div class="col-lg-3">


                            <div class="card card-custom">
                                <div class="card-header">
                                    <div class="card-title">
                                        <span class="card-icon">
                                            <i class="flaticon2-chat-1 text-primary"></i>
                                        </span>
                                        <a href="{{ route("client.single_project", $items->id) }}"><h3 class="card-label">{{ $items->project_name }}</h3> </a>
                                    </div>
                                    <div class="card-toolbar">
                                        <a href="#" class="btn btn-sm btn-icon btn-light-success mr-2">
                                            <i class="flaticon2-gear"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-icon btn-light-primary">
                                            <i class="flaticon2-bell-2"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="progress mb-6">
                                            {{-- progress bar viewer starts--}}
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="progress_bar{{ $items->id }}" role="progressbar"  aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            {{-- progress bar viewer ends--}}

                                    </div>

                                    <div class="pb-2 row">
                                        <div class="col">
                                            Tasks :
                                            <span id="task_done{{ $items->id }}">

                                            </span>
                                            /
                                            <span id="total_task{{ $items->id }}">

                                            </span>
                                        </div>
                                        <div>
                                            Due Date: <b>{{ \Carbon\Carbon::parse($items->due_date)->format('d/m/Y')}}</b>
                                        </div>

                                    </div>

                                    {{-- <div>
                                        <a href="{{ route("client.single_project", $items->id) }}"> <button class="btn btn-primary btn-sm">View Details</button> </a>
                                    </div> --}}
                                </div>
                            </div>

                </div>

                <script>
                            var percentange = 0;
                            var total_task = 0;
                            var subtask = {!! $items->subtask !!};
                            if(subtask.length == 0){
                                percentange  = -1;
                            }else{
                                subtask.forEach(element => {
                                if(element.stage == "true"){
                                        percentange +=1;
                                }
                                total_task +=1;
                                });
                                document.getElementById("task_done"+{!! $items->id !!}).innerHTML = percentange;
                                document.getElementById("total_task"+{!! $items->id !!}).innerHTML = total_task;
                                percentange = (percentange/subtask.length)*100;

                                document.getElementById("progress_bar"+{!! $items->id !!}).style.width = percentange+"%";
                            }
                    </script>
         @endforeach
    @else
        <div class="col-lg-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="fas fa-info-circle text-primary"></i>
                        </span>
                        <h5 class="card-label">No {{ ucfirst(trans($stage))  }} Projects</h5>
                    </div>
                </div>
            </div>
        </div>
    @endif


    </div>
</div>
@endsection
@section("scripts")
<!--begin::Page Vendors Styles(used by this page)-->


<!--end::Page Vendors Styles-->
@endsection

