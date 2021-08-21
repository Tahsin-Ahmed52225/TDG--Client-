@extends('layouts.manager_layout')
@section("links")
<link rel="stylesheet" href="{{ asset("assets/css/tag.input.css") }}">
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
                                         <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a style="color:white;" href="{{ route("admin.view_member") }}"> <u>View Member</u> </a> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>

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
                    <form  action=#>
                    @csrf
                     <div class="card-body">
                         <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="tdg_name"/>
                            </div>

                         </div>
                         <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Assignee <span class="text-danger">*</span></label>
                                <input type="text" data-role="tagsinput" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Due Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tdg_phone"/>
                            </div>

                         </div>
                         <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Status <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1" name="tdg_position">
                                    <option value="Manager">Manager</option>
                                    <option value="Web developer">Web Developer</option>
                                    <option value="Desiger">Designer</option>
                                    <option value="Content writer">Content Writer</option>
                                    <option value="Support">Support</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Priority<span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1" name="tdg_position">
                                    <option value="Manager">Manager</option>
                                    <option value="Web developer">Web Developer</option>
                                    <option value="Desiger">Designer</option>
                                    <option value="Content writer">Content Writer</option>
                                    <option value="Support">Support</option>
                                </select>
                            </div>
                         </div>

                      <div class="form-group">
                        <div class="form-group mb-1">
                            <label for="exampleTextarea">Description
                            <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">Upload Files:</label>
                        <div class="col-lg-9">
                            <div class="dropzone dropzone-multi" id="kt_dropzone_4">
                                <div class="dropzone-panel mb-lg-0 mb-2">
                                    <a class="dropzone-select btn btn-light-primary font-weight-bold btn-sm">Attach files</a>
                                    <a class="dropzone-upload btn btn-light-primary font-weight-bold btn-sm">Upload All</a>
                                    <a class="dropzone-remove-all btn btn-light-primary font-weight-bold btn-sm">Remove All</a>
                                </div>
                                <div class="dropzone-items">
                                    <div class="dropzone-item" style="display:none">
                                        <div class="dropzone-file">
                                            <div class="dropzone-filename" title="some_image_file_name.jpg">
                                                <span data-dz-name="">some_image_file_name.jpg</span>
                                                <strong>(
                                                <span data-dz-size="">340kb</span>)</strong>
                                            </div>
                                            <div class="dropzone-error" data-dz-errormessage=""></div>
                                        </div>
                                        <div class="dropzone-progress">
                                            <div class="progress">
                                                <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-toolbar">
                                            <span class="dropzone-start">
                                                <i class="flaticon2-arrow"></i>
                                            </span>
                                            <span class="dropzone-cancel" data-dz-remove="" style="display: none;">
                                                <i class="flaticon2-cross"></i>
                                            </span>
                                            <span class="dropzone-delete" data-dz-remove="">
                                                <i class="flaticon2-cross"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="form-text text-muted">Max file size is 1MB and max number of files is 5.</span>
                        </div>
                    </div>



                     </div>





                     <div class="card-footer">
                      {{-- <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                     </div>
                    </form>
                    <!--end::Form-->
                   </div>
            </div>
        </div>
        {{-- <div class="d-flex flex-column-fluid col-md-6">
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
                                         <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a style="color:white;" href="{{ route("admin.view_member") }}"> <u>View Member</u> </a> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>

                                    @else
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endif
                @endforeach
                <div class="card card-custom">
                    <div class="card-header">
                     <h3 class="card-title">
                       Add Member
                     </h3>
                    </div>
                    <!--begin::Form-->
                    <form method="POST" action={{ route('admin.add_member') }}>
                    @csrf
                     <div class="card-body">
                         <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  placeholder="Enter name" name="tdg_name"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control"  placeholder="Enter email" name="tdg_email"/>
                            </div>

                         </div>
                         <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  placeholder="Enter phone" name="tdg_phone"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1">Select designation <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1" name="tdg_position">
                                    <option value="Manager">Manager</option>
                                    <option value="Web developer">Web Developer</option>
                                    <option value="Desiger">Designer</option>
                                    <option value="Content writer">Content Writer</option>
                                    <option value="Support">Support</option>
                                </select>
                            </div>

                         </div>

                      <div class="form-group">
                       <label for="exampleInputPassword1">Password <span class="text-danger">*</span></label>
                       <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="tdg_password"/>
                      </div>
                     </div>
                     <div class="card-footer">
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-secondary">Cancel</button>
                     </div>
                    </form>
                    <!--end::Form-->
                   </div>
            </div>
        </div> --}}
    </div>

</div>

@endsection

@section("scripts")
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> --}}
<script src="{{ asset("assets/js/tag.input.js") }}"></script>
<script src="{{ asset("assets/js/typehead.js") }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
<script src="{{ asset("assets/js/pages/crud/file-upload/dropzonejs.js") }}"></script>

@endsection
