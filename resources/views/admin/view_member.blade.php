@extends('layouts.admin_layout')

@section("links")
        <!--begin::Page Vendors Styles(used by this page)-->
		<link href="{{ asset("assets/plugins/custom/datatables/datatables.bundle.css") }}" rel="stylesheet" type="text/css" />
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset("dev-assets/css/style.css") }}">
		<!--end::Page Vendors Styles-->
@endsection
@section('content')


<div class="content d-flex flex-column flex-column-fluid " id="kt_content" style="padding-top: 0px;" >
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->

        <div class="container">
            <div class="flash-message"></div>

            <!--begin::Card-->
            <div class="card card-custom gutter-b" id="error_holder">

                <div class="card-header flex-wrap border-0 pt-6 pb-0">

                    <div class="card-title">
                        <h3 class="card-label">View All Member
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Export</button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover py-2">
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-print"></i>
                                            </span>
                                            <span class="navi-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-copy"></i>
                                            </span>
                                            <span class="navi-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-excel-o"></i>
                                            </span>
                                            <span class="navi-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-text-o"></i>
                                            </span>
                                            <span class="navi-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-pdf-o"></i>
                                            </span>
                                            <span class="navi-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->
                    </div>
                </div>

                <div class="card-body" style="overflow-X: scroll;">

                    <!--begin: Datatable-->
                   <table class="table table-bordered table-hover table-checkable text-center "  id="kt_datatable" >
                        <thead>
                             <tr >

                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Position</th>
                                <th>Stage</th>
                                <th>Actions</th>
                              </tr>

                        </thead>
                        <tbody >

                            @foreach ($users as $values )
                                <tr id="row{{ $values->id }}" >

                                    <td style="padding: 17px 5px !important;">{{ $values->id }}</td>
                                    <td id="name{{ $values->id }}"  style="padding: 17px 5px !important;"  ondblclick="updateName({!! $values->id !!})">{{ $values->name }}</td>
                                    <td id="email{{ $values->id }}" style="padding: 17px 5px !important;" ondblclick="updateEmail({!! $values->id !!})">{{ $values->email }}</td>
                                    <td id="number{{ $values->id }}"  style="padding: 17px 5px !important;" ondblclick="updatePhone({!! $values->id !!})">{{ $values->number }}</td>
                                    <td  style="padding: 17px 5px !important;">

                                        <div  style="display:none;" id="position-edit{{ $values->id }}">
                                             <select style="border:none" id="positionD{{ $values->id }}">
                                                 <option >Manager</option>
                                                 <option >Web developer</option>
                                                 <option >Designer</option>
                                                 <option >Content Writer</option>
                                                 <option>Support</option>
                                             </select>
                                        </div>
                                       <div id="position{{ $values->id }}" ondblclick="updatePosition({!! $values->id !!})">
                                           {{ $values->position }}
                                       </div>


                                    </td>
                                    @if($values->verified == 1)
                                           <td  style="padding: 17px 5px !important;" class="text-success">Verified</td>
                                    @else
                                           <td style="padding: 17px 5px !important;"  class="text-warning">Not Verified</td>
                                    @endif
                                    <td >

                                        <div class="row">
                                            <div class="col d-flex align-items-center justify-content-end   " onclick="deleteMember({!! $values->id !!})">
                                                <i class="fas fa-trash-alt p_icon"></i>
                                            </div>

                                            <div class="col d-flex align-items-center justify-content-start" >
                                                <input class="switchT" data-stage={{ $values->stage }}  data-user = {{ $values->id }}  id="toggle{{ $values->id }}" type="checkbox" data-on="Lock" data-off="Unlock" data-toggle="toggle"  data-width="95" data-height="10" data-offstyle="danger" <?php if($values->stage == 1) echo "checked";?> >
                                            </div>



                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>


@endsection

@section("scripts")

        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

		<!--begin::Page Vendors(used by this page)-->
		<script src="{{ asset("assets/plugins/custom/datatables/datatables.bundle.js") }}"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ asset("assets/js/pages/crud/datatables/data-sources/html.js") }}"></script>
		<!--end::Page Scripts-->
        <script src="{{ asset("dev-assets/js/script.js") }}"></script>

        <script>
                $(document).on('click', '.toggle', function () {
                    let id = $(this).children(".switchT").attr("data-user");
                    let stage = $(this).children(".switchT").attr("checked");
                    switchT(id, stage);
                });

        </script>

@endsection
