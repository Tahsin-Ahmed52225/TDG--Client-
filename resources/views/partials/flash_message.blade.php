@if( Session::has("success") )
<div class="alert bg-success text-white alert-block" role="alert">
    <button class=" close " data-dismiss="alert">&times;</button>
    {{ Session::get("success") }}
</div>
@endif


@if( Session::has("error") )
<div class="alert alert-danger alert-block" role="alert">
    <button class="close" data-dismiss="alert">&times;</button>
    {{ Session::get("error") }}
</div>
@endif

