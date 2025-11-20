@extends('layouts/backend/main')
@section('main-section')

<style>
    .pro-pic img {
        width: 30px;
        height: 30px;
    }
</style>

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Advertisement</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Advertisement</li>
                    </ol>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewModal">
                        Add New
                    </button>
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
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="250">250</option>
                                            <option value="500">500</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <form class="theme-form" method="GET" action="">
                                            <div class="form-group d-flex justify-content-end">
                                                <input class="form-control" name="search" type="text"
                                                    placeholder="Search with title" value="">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="table-responsive">
                            @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count = $page_number * 10 - 9;  @endphp 
                                <table class="table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th scope="col">S.NO</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Running status</th>
                                            <th scope="col">View Status</th>
                                            <th scope="col" class="d-flex justify-content-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        @foreach($ads_list as $ads) 
                                        <tr class="{{$ads->status == '0' ? 'tr_disable':'tr_enable'}}">
                                            <th scope="row">{{$count++}}</th>
                                            <td class="pro-pic">
                                                <img src="{{url($ads->image)}}" alt="{{$ads->title}}">
                                            </td>
                                            <td>{{$ads->title}}</td>
                                            <td>{{$ads->start_date}}</td>
                                            <td>{{$ads->end_date}}</td>
                                            <td>{{$ads->size}}</td>
                                            <td>{{$ads->position}}</td>
                                            <td>{{$ads->price != '' ? 'Rs.': '-'}} {{$ads->price}}{{$ads->price != '' ? '/-': ' '}}</td>
                                            <td>
                                                @if($current_date >= $ads->start_date && $current_date <= $ads->end_date)
                                                <p style="color: green;"><i class="fa fa-check-circle" style="font-size: 21px;"></i> Running</p>
                                                @elseif($current_date > $ads->end_date)
                                                <p style="color: red;"><i class="fa fa-times-circle" style="font-size: 21px;"></i> Ended</p>
                                              
                                                @elseif($current_date < $ads->start_date)
                                                <p style="color: orange;"><i class="fa fa-clock-o" style="font-size: 21px;"></i> Up Comming</p>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                <input data-id="{{$ads->id}}" class="form-check-input status" type="checkbox" role="switch" id="status" {{$ads->status == '1' ? 'checked':''}}>
                                            </div>
                                        </td> 

                                            <td class="d-flex justify-content-center ">
                                                <button value="{{$ads->id}}" class="edit_button btn btn-primary m-r-10"
                                                    id="edit_button"><i class="fa fa-edit"></i></button>
                                                <button value="{{$ads->id}}" class="delete_button btn btn-primary mx-2"><i
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
                  {{$ads_list->links('pagination::bootstrap-5')}}<br>
               </div>
            </div>
        </div>

        @if($ads_list->count() == 0)
    <div class="pt-4">
    <h5 class="text-center">No Data Available</h5>
    </div>
    @endif
    </div>
    <!-- Container-fluid Ends-->
</div>


<!-- Add New Modal -->
<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Image/Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('admin.advertisement.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control" id="title" type="text" name="title"
                            placeholder="Enter File Title" required="">
                    </div>
                    <div class="row">
                    <div class="col-md-6 mt-3">
                        <label class="form-label" for="start_date">Start Date</label>
                        <input class="form-control" id="start_date" type="date" name="start_date" required="" onchange="updateEndDateMin()">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="form-label" for="end_date">End Date</label>
                        <input class="form-control" id="end_date" type="date" name="end_date" required="">
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-8 mt-3">
                        <label class="form-label" for="image">Upload File</label>
                        <input accept="image/*" class="form-control" id="image" type="file" name="image" required="">
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="form-label" for="price">Price</label>
                        <input class="form-control" id="price" type="number" name="price" placeholder="Rs."  min="1">
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label class="col-form-label">Ad Size:</label>
                            <select class="col-sm-4 form-control" name="size" id="size" required="">
                            <option value="">--Select Size--</option> 
                                <option value="large">Large (Vertical)</option>
                                <option value="small">Small (Square)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="col-form-label">Ad Position:</label>
                            <select class="col-sm-4 form-control" name="position" id="position" required="">
                                <option value="">--Select Position--</option>
                                <option value="top">Top</option>
                                <option value="middle">Middle</option>
                                <option value="bottom">Bottom</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12 mt-3">
                        <label class="form-label" for="email">User Email</label>
                        <input class="form-control" id="email" type="text" name="email"
                            placeholder="Email" required="">
                    </div>
                    </div>
                     <div class="row">
                    <div class="col-md-12 mt-3">
                        <label class="form-label" for="email">Target URL</label>
                        <input class="form-control" id="target_url" type="url" name="target_url"
                            placeholder="Target URL" required="">
                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Add New End -->

<!-- Edit Modal Start -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit Image/Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.advertisement.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="col-md-12">
                        <label class="form-label" for="edit_title">Title</label>
                        <input class="form-control" id="edit_title" type="text" name="edit_title"
                            placeholder="Enter File Title" required="">
                            <div class="row">
                        <div class="col-md-6 mt-3">
                            <label class="form-label" for="edit_start_date">Start Date</label>
                            <input class="form-control" id="edit_start_date" type="date" name="edit_start_date" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label" for="edit_end_date">End Date</label>
                            <input class="form-control" id="edit_end_date" type="date" name="edit_end_date" required onchange="updateEndDateMin()">
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-8 mt-3">
                            <label class="form-label" for="edit_image">Upload File</label>
                            <input accept="image/*" class="form-control" id="edit_image" type="file" name="edit_image">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="form-label" for="edit_price">Price</label>
                            <input class="form-control" id="edit_price" type="number" name="edit_price" required="" min="1">
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label class="col-form-label">Ad Size:</label>
                                <select class="col-sm-4 form-control" name="edit_size" id="edit_size">
                                    <option value="large">Large (Vertical)</option>
                                    <option value="small">Small (Square)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="col-form-label">Ad Position:</label>
                                <select class="col-sm-4 form-control" name="edit_position" id="edit_position">
                                    <option value="top">Top</option>
                                    <option value="middle">Middle</option>
                                    <option value="bottom">Bottom</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                    <div class="col-md-12 mt-3">
                        <label class="form-label" for="edit-email">User Email</label>
                        <input class="form-control" id="edit_email" type="text" name="edit_email" placeholder="Email" required="">
                    </div>
                     <div class="row">
                    <div class="col-md-12 mt-3">
                        <label class="form-label" for="email">Target URL</label>
                        <input class="form-control" id="target_url" type="url" name="target_url"
                            placeholder="Target URL" required="">
                    </div>
                    </div>
                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal End -->

<!-- java script code start  -->
@section('javascript-section')



    @if(Session::has('added'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Success",
      text: "{{(Session::get('added'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('not_added'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('not_added'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif


@if(Session::has('updated'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Success",
      text: "{{(Session::get('updated'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('not_update'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('not_update'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif


@if(Session::has('deleted'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Success",
      text: "{{(Session::get('deleted'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('not_deleted'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('not_deleted'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif

<script>
    $(document).ready(function () { 

    // Edit Modal Start here
    $(document).on('click', '.edit_button', function () {
      var id = $(this).val();
      $('#editModal').modal('show');
      $.ajax({
        type: "GET",
        data: { 'id': id },
        url: "{{route('admin.advertisement.edit')}}",
        success: function (response) {   
          $('#edit_id').val(response.data.id)
          $('#edit_title').val(response.data.title)
          $('#edit_start_date').val(response.data.start_date);
          $('#edit_end_date').val(response.data.end_date);
          $('#edit_price').val(response.data.price);
          $('#edit_size').val(response.data.size);
          $('#edit_position').val(response.data.position);
          $('#edit_email').val(response.data.email);
           
        }
      });
    });
    // Edit Modal End here


    $(document).on('change', '#qty', function () {
      const qty = $(this).val();
      var current_url = "{{('admin.ategory.index')}}";
      window.location.replace(current + '?qty=' + qty); 
    }); 
    });
 
    // delete category request start
    $(document).on('click', '.delete_button', function () {
        var id = $(this).val(); 
        swal({
            title: "Are you sure?",
            text: "You want to remove this permanently ?",
            icon: "warning",
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "{{route('admin.advertisement.destroy')}}",
                    method: "GET",
                    data: { 'id': id },
                    success: function (){
                        swal({
                            title: "Success",
                            text: "Advertisement has been removed!",
                            icon: "success",
                            button: "Ok"
                        }).then(function (){
                            window.location.reload();
                        });
                    },
                });
            } else{
                swal("Cancelled", "You dont delete any file !", "error");
            }
        })
    }); 
    // delete category request end 

    $(document).on('change', '.status', function (){
        var $toggleButton = $(this);
        var status = $toggleButton.prop('checked') ? 1 : 0;
        var id = $(this).data('id'); 
        $.ajax({
            type: "GET",
            url: "{{route('admin.advertisement.status_update')}}",
            data: { 'status': status, 'id': id },
            success: function (data) {
                if (data.status == 200 && data.message == 'status_updated'){
                    swal('Status Changed Successfully');
                    // Change the row color based on the button's status
                    var row = $toggleButton.closest('tr');
                    if (status == 1){
                        // Enable the row (remove the disabled class)
                        row.removeClass('tr_disable');
                    }else{
                        // Disable the row (add the disabled class)
                        row.addClass('tr_disable');
                    }
                }
            }
        });
    });
 
</script>
<script>
  // Get today's date in the format YYYY-MM-DD
  function getToday() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  }

  function updateEndDateMin() {
    // Get the value of the start date input
    const startDateInput = document.getElementById('start_date');
    const startDateValue = startDateInput.value;

    // Calculate the next day
    const nextDay = new Date(startDateValue);
    nextDay.setDate(nextDay.getDate() + 1);

    // Set the minimum value for the end date input to the next day
    const endDateInput = document.getElementById('end_date');
    endDateInput.min = nextDay.toISOString().split('T')[0];

    // Automatically select the next day in the end date input
    endDateInput.value = endDateInput.min;
  }

  // Set the minimum value for the start date input to today
  const startDateInput = document.getElementById('start_date');
  startDateInput.min = getToday();

  // Set the minimum value for the end date input to today
  const endDateInput = document.getElementById('end_date');
  endDateInput.min = getToday();

  // Attach the updateEndDateMin function to the change event of the start date input
  startDateInput.addEventListener('change', updateEndDateMin);
</script>





@endsection
@endsection