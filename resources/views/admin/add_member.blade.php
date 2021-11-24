@extends('layouts.admin_layout')



@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
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
    </div>
</div>





@endsection

