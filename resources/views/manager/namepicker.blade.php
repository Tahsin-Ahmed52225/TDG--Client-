@extends('layouts.manager_layout')

@section("links")
<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.css") }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset("dev-assets/css/name_picker.css") }}">
<!--end::Page Vendors Styles-->
@endsection
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" >
    <div class="overlay">
        <canvas id="world"></canvas>
        <h1 id="winner"></h1>
        <svg id="close" aria-hidden="true" data-prefix="far" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10 fa-3x"><path fill="white" d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z" class=""></path></svg>
    </div>
    <!--begin::Entry-->
        <div class="d-flex flex-column-fluid ">
            <!--begin::Container-->
            <div class="container">

                <div class="row">
                    <div class="col-6 offset-3 ">
                        <div class="card" style="margin-top: 50%">
                            <div class="card-body card-sm">
                                <div class="namepicker">
                                    <input id="names" type="text" placeholder="Each name followed by a ‘ , ‘" value="{{ $names }}">
                                    <a href="#" id ="pick" class="btn btn-primary">Pick a name</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                 {{-- <div class="overlay">
                    <canvas id="world"></canvas>
                    <h1 id="winner"></h1>
                    <svg id="close" aria-hidden="true" data-prefix="far" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10 fa-3x"><path fill="white" d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z" class=""></path></svg>
                  </div> --}}
            </div>
        </div>
</div>

@endsection

@section("scripts")
   <script src="{{ asset("dev-assets/js/name_picker.js") }}"></script>
   <script src="{{ asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.js") }}"></script>
   <script src="{{ asset("assets/js/pages/widgets.js") }}"></script>
@endsection
