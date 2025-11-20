@extends('layouts/backend/main')
@section('main-section')

<style>
    .pro-pic img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
    .card-body .select2{
        width:67px !important;
    }
  
</style>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Team</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Team</li>
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
                                <div class="col-md-3 mt-3">
                                    <div class="card-body">
                                        <label class="col-form-label">Row:</label>
                                        <select class="js-example-basic-single col-sm-4" id="drop" name="qty" id="qty">
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
                                <div class="col-md-5 pt-3">
                                    <div class="card-body">
                                        <form class="theme-form" method="GET" action="{{URL::full()}}">
                                            <div class="form-group d-flex justify-content-end">
                                                <input class="form-control" name="search" type="text"
                                                    placeholder="Search name"
                                                    value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4  mt-3 pt-4">
                                    <div class="">
                                        <form method="POST" action="{{route('admin.team.store')}}" class="d-flex">
                                            @csrf
                                            <label class="col-form-label">Select User:</label>
                                            <select class="js-example-basic-single col-sm-4" name="team_user"
                                                id="team_user">
                                                <option value="">Select</option>
                                                @foreach($user_list as $user)
                                                <option value="{{$user->id}}">{{$user->name}} -
                                                    (@if($user->user_type == 2)
                                                    Writer
                                                    @elseif($user->user_type == 3)
                                                    User
                                                    @else
                                                    Admin
                                                    @endif)
                                                </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary">Add in Team</button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- <div class="container"> -->
                           
                            <!-- </div> -->
                            <div class="table-responsive">
                                @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;}
                                $count = $page_number * 10 - 9; @endphp
                                <table class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th scope="col">S.NO</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Type</th>
                                            <th scope="col" class="d-flex justify-content-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($team_list as $team)
                                        <tr class="tr_enable">
                                            <th scope="row">{{$count++}}</th>
                                            <td class="pro-pic">
                                                <img src="{{
                                                    url('public/build/assets/upload/user/profile_image')}}/{{$team->profile_image ?? 'default_user.png'}}"
                                                    alt="">
                                            </td>
                                            <td>{{$team->name}}</td>
                                            <td>
                                                @if($team->user_type == 2)
                                                Writer
                                                @elseif($team->user_type == 3)
                                                User
                                                @else
                                                Admin
                                                @endif
                                            </td>

                                            <td class="d-flex justify-content-center ">
                                                <button value="{{$team->id}}"
                                                    class="delete_button btn btn-primary mx-2"><i
                                                        class="fa fa-trash-o"></i></button>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                  {{$team_list->links('pagination::bootstrap-5')}}<br>
               </div>
                <div>
                    <br>
                </div>
            </div>
        </div>

        @if($team_list->count() == 0)
    <div class="pt-4">
    <h5 class="text-center">No Data Available</h5>
    </div>
    @endif
    </div>
    <!-- Container-fluid Ends-->
</div>



<!-- java script code start  -->
@section('javascript-section')


<script>
    $(document).ready(function ()
    {
        // Assuming your button has the class "edit_button"
        $(".edit_button").on("click", function ()
        {
            // Get the modal element by its ID
            var modal = $("#editModal");

            // Show the modal
            modal.modal("show");
        });
    });
    // Edit Modal End here


    // delete category request start
    $(document).on('click', '.delete_button', function ()
    {
        var id = $(this).val();
        console.log(id);
        swal({
            title: "Are you sure?",
            text: "You want to remove this permanently ?",
            icon: "warning",
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true,
        }).then(function (isConfirm)
        {
            if (isConfirm)
            {
                $.ajax({
                    url: "{{route('admin.team.remove')}}",
                    method: "GET",
                    data: { 'id': id },
                    success: function ()
                    {
                        swal({
                            title: "Success",
                            text: "User has been removed from team !",
                            icon: "success",
                            button: "Ok"
                        }).then(function ()
                        {
                            window.location.reload();
                        });
                    },
                });
            } else
            {
                swal("Cancelled", "You dont delete any file !", "error");
            }
        })
    });

    // delete category request end


    $(document).on('change', '.gallery_status_checkbox', function ()
    {
        var $toggleButton = $(this);
        var gallery_status = $toggleButton.prop('checked') ? 1 : 0;
        var gallery_id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: "{{route('admin.gallery.update_status')}}",
            data: { 'gallery_status': gallery_status, 'gallery_id': gallery_id },
            success: function (data)
            {
                if (data.status == 200 && data.message == 'status_updated')
                {
                    swal('Status Changed Successfully');
                    // Change the row color based on the button's status
                    var row = $toggleButton.closest('tr');
                    if (category_status == 1)
                    {
                        // Enable the row (remove the disabled class)
                        row.removeClass('tr_disable');
                    } else
                    {
                        // Disable the row (add the disabled class)
                        row.addClass('tr_disable');
                    }
                }
            }
        });
    });



   //  Select Row
   $(document).on('change', '#qty', function () {
      const qty = $(this).val();
      var current_url = "{{route('admin.team.index')}}";
      window.location.replace(current_url + '?qty=' + qty);

    });
</script>


@endsection


@endsection