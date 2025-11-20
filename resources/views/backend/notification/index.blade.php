@extends('layouts/backend/main')
@section('main-section')

<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Notifications</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Notifications</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <label class="col-form-label">Row:</label>
                                        <select class="js-example-basic-single col-sm-4" name="qty" id="qty">
                                            <option value="10" {{isset($_GET['qty']) && $_GET['qty']=='10' ? 'selected'
                                                : '' }}>10</option>
                                            <option value="20" {{isset($_GET['qty']) && $_GET['qty']=='20' ? 'selected'
                                                : '' }}>20</option>
                                            <option value="50" {{isset($_GET['qty']) && $_GET['qty']=='50' ? 'selected'
                                                : '' }}>50</option>
                                            <option value="100" {{isset($_GET['qty']) && $_GET['qty']=='100'
                                                ? 'selected' : '' }}>100</option>
                                            <option value="250" {{isset($_GET['qty']) && $_GET['qty']=='250'
                                                ? 'selected' : '' }}>250</option>
                                            <option value="500" {{isset($_GET['qty']) && $_GET['qty']=='500'
                                                ? 'selected' : '' }}>500</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;}
                                $count = $page_number * 10 - 9; @endphp
                                <table class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th scope="col">SNO</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_notification as $notification)
                                        <tr class=" ">
                                            <th scope="row">{{$count++}}</th>
                                            <td>{{$notification->title}}</td>
                                            <td>{{$notification->description}}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div>
                    {{$all_notification->links('pagination::bootstrap-5')}}<br>
                </div>
            </div>

        </div>



    </div>
    <!-- Container-fluid Ends-->
</div>

</div>
</div>
</div>
<!-- Container-fluid starts-->

<!-- Container-fluid Ends-->
</div>
<!-- tap on top starts-->
<div class="tap-top"><i class="icon-control-eject"></i></div>
<!-- tap on tap ends-->

@endsection

@section('javascript-section')
@if(Session::has('success'))
<script type="text/javascript">
    $(document).ready(function ()
    {
        swal({
            title: "Success",
            text: "{{(Session::get('success'))}}",
            icon: "success",
            button: "Ok"
        });
    });
</script>
@elseif(Session::has('faild'))
<script type="text/javascript">
    $(document).ready(function ()
    {
        swal({
            title: "Failed",
            text: "{{(Session::get('faild'))}}",
            icon: "error",
            button: "Ok"
        });
    });
</script>
@endif

@if(Session::has('update_success'))
<script type="text/javascript">
    $(document).ready(function ()
    {
        swal({
            title: "Success",
            text: "{{(Session::get('update_success'))}}",
            icon: "success",
            button: "Ok"
        });
    });
</script>
@elseif(Session::has('update_failed'))
<script type="text/javascript">
    $(document).ready(function ()
    {
        swal({
            title: "Failed",
            text: "{{(Session::get('update_failed'))}}",
            icon: "error",
            button: "Ok"
        });
    });
</script>
@elseif(Session::has('hindi_exist'))
<script type="text/javascript">
    $(document).ready(function ()
    {
        swal({
            title: "Failed",
            text: "{{(Session::get('hindi_exist'))}}",
            icon: "error",
            button: "Ok"
        });
    });
</script>
@elseif(Session::has('english_exist'))
<script type="text/javascript">
    $(document).ready(function ()
    {
        swal({
            title: "Failed",
            text: "{{(Session::get('english_exist'))}}",
            icon: "error",
            button: "Ok"
        });
    });
</script>
@elseif(Session::has('already_exist'))
<script type="text/javascript">
    $(document).ready(function ()
    {
        swal({
            title: "Failed",
            text: "{{(Session::get('already_exist'))}}",
            icon: "error",
            button: "Ok"
        });
    });
</script>
@endif



<!-- some error accured when submit -->
@if(Session::has('error'))
<script type="text/javascript">
    $(document).ready(function ()
    {
        swal({
            title: "Failed",
            text: "{{(Session::get('error'))}}",
            icon: "error",
            button: "Ok"
        });
    });
</script>
@endif



@if(Auth::user()->user_type == 1)
<script>
    $(document).ready(function ()
    {
        $(document).on('change', '#qty', function ()
        {
            const qty = $(this).val();
            var current_url = "{{route('admin.all_notification')}}";
            window.location.replace(current_url + '?qty=' + qty);
        });
    });
</script>
@elseif(Auth::user()->user_type == 2)
<script>
    $(document).ready(function ()
    {
        $(document).on('change', '#qty', function ()
        {
            const qty = $(this).val();
            var current_url = "{{route('writer.all_notification')}}";
            window.location.replace(current_url + '?qty=' + qty);
        });
    });
</script>
@elseif(Auth::user()->user_type == 3)
<script>
    $(document).ready(function ()
    {
        $(document).on('change', '#qty', function ()
        {
            const qty = $(this).val();
            var current_url = "{{route('user.all_notification')}}";
            window.location.replace(current_url + '?qty=' + qty);
        });
    });
</script>
@endif
@endsection