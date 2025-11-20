@extends('layouts/backend/main')
@section('main-section')
 
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Gallery</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Gallery List</li>
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
                      <option value="10" {{isset($_GET['qty']) && $_GET['qty']=='10' ? 'selected' : '' }}>10</option>
                      <option value="20" {{isset($_GET['qty']) && $_GET['qty']=='20' ? 'selected' : '' }}>20</option>
                      <option value="50" {{isset($_GET['qty']) && $_GET['qty']=='50' ? 'selected' : '' }}>50</option>
                      <option value="100" {{isset($_GET['qty']) && $_GET['qty']=='100' ? 'selected' : '' }}>100</option>
                      <option value="250" {{isset($_GET['qty']) && $_GET['qty']=='250' ? 'selected' : '' }}>250</option>
                      <option value="500" {{isset($_GET['qty']) && $_GET['qty']=='500' ? 'selected' : '' }}>500</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-body">
                    <form class="theme-form" method="GET" action="{{URL::full()}}">
                      <div class="form-group d-flex justify-content-end">
                        <input class="form-control" name="search" type="text" placeholder="Search by Title"
                          value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count =
                $page_number * 10 - 9; @endphp
                <table class="table">
                  <thead class="bg-primary">
                    <tr>
                      <th scope="col">S.NO</th>
                      <th scope="col">Title(hi)</th>
                      <th scope="col">Title(en)</th>
                      <th scope="col">Item</th>
                      <th scope="col">File Type</th>
                      <th scope="col">Status</th>
                      <th scope="col" class=" ">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($galleryItems as $item)
                    <tr class="{{$item->status == '0' ? 'tr_disable':'tr_enable'}}">
                      <th scope="row">{{$count++}}</th>
                      <td>{{$item->title_hi}}</td>
                      <td>{{$item->title_en}}</td>
                      @if($item->type == 'image')
                      <td><img src="{{url($item->file_path)}}" width="300px"></td>
                      @else
                      <td>
                        <video width="300" controls>
                          <source src="{{url($item->file_path)}}" type="video/mp4">
                          Your browser does not support HTML video.
                        </video>
                      </td>
                      @endif
                      <td>{{$item->type}}</td>
                      <td>
                        <div class="form-check form-switch">
                          <input data-id="{{$item->id}}" class="form-check-input gallery_status_checkbox"
                            type="checkbox" role="switch" id="gallery_status_checkbox" {{$item->status == '1' ?
                          'checked':''}}>
                        </div>
                      </td>
                      <td class="text-center " style="">
                      <div class="d-flex">
                        <button value="{{$item->id}}" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></button>
                        <button value="{{$item->id}}" class="delete_button btn btn-primary"><i class="fa fa-trash-o"></i></button>
                      </div>
                       
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
          {{$galleryItems->links('pagination::bootstrap-5')}}<br>
        </div>
      </div>

    </div>

    @if($galleryItems->count() == 0)
    <div class="pt-4">
    <h5 class="text-center">No Data Available</h5>
    </div>
    @endif
  </div>
  <!-- Container-fluid Ends-->
</div>
<!-- tap on top starts-->
<div class="tap-top"><i class="icon-control-eject"></i></div>
<!-- tap on tap ends-->
<!-- Modal -->
<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Image/Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('admin.gallery.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="col-md-12">
            <label class="form-label" for="file_title_hi">Title(hi)</label>
            <input class="form-control" id="file_title_hi" type="text" name="file_title_hi" placeholder="Enter File Title (hi)"
              required="">
          </div>

          <div class="col-md-12">
            <label class="form-label" for="file_title_en">Title(en)</label>
            <input class="form-control" id="file_title_en" type="text" name="file_title_en" placeholder="Enter File Title (en)"
              required="">
          </div>

          <div class="col-md-12 mt-3">
            <label class="form-label" for="upload_file">Upload File</label>
            <input class="form-control" id="upload_file" type="file" name="selected_file[]" required="" multiple
              onchange="validateImageCount()">
          </div>

          <div class="col-md-12">
            <label class="form-label" for="file_type">File Type</label>
            <select class="form-select" id="file_type" name="file_type" required>
              <option selected value="">--Select--</option>
              <option value="image">Image</option>
              <option value="video">Video</option>
            </select>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal">Edit Image/Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.gallery.update')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="edit_file_id" id="edit_file_id">
          <div class="col-md-12">
            <label class="form-label" for="edit_file_title_hi">Title(hi)</label>
            <input class="form-control" id="edit_file_title_hi" type="text" name="edit_file_title_hi"
              placeholder="Enter File Title" required="">
          </div>
          <div class="col-md-12">
            <label class="form-label" for="edit_file_title_en">Title(en)</label>
            <input class="form-control" id="edit_file_title_en" type="text" name="edit_file_title_en"
              placeholder="Enter File Title" required="">
          </div>
          <div class="col-md-12 mt-3">
            <label class="form-label" for="edit_upload_file">Upload File</label>
            <input class="form-control" id="edit_upload_file" type="file" name="edit_upload_file">
          </div>

          <div class="col-md-12">
            <label class="form-label" for="edit_file_type">File Type</label>
            <select class="form-select" id="edit_file_type" name="edit_file_type" required>
              <option selected value="">--Select--</option>
              <option value="image">Image</option>
              <option value="video">Video</option>
            </select>
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
@endif

<script>
  function validateImageCount()
  {
    var input = document.getElementById('upload_file');
    var maxImages = 10; // Set your desired maximum number of images
    if (input.files.length > maxImages)
    {
      alert('You can only select up to ' + maxImages + ' files.');
      // Clear the selected files
      input.value = '';
    }
  }
</script>

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

<script>
  // Edit modal setup value
  $(document).ready(function ()
  {
    $(document).on('click', '.edit_button', function ()
    {
      var file_id = $(this).val();
      $('#editModal').modal('show');
      $.ajax({
        type: "GET",
        url: "gallery/edit/" + file_id,
        success: function (response)
        {
          $('#edit_file_id').val(response.id);
          $('#edit_file_title_en').val(response.title_en);
          $('#edit_file_title_hi').val(response.title_hi);
          $('#edit_file_type').val(response.type);

        }
      });
    });


    // delete category reques
    $(document).on('click', '.delete_button', function ()
    {
      var file_id = $(this).val();
      swal({
        title: "Are you sure?",
        text: "You want to delete this permanently ?",
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
            url: "gallery/destroy/" + file_id,
            method: "GET",
            success: function ()
            {
              swal({
                title: "Success",
                text: "Category has been deleted !",
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
    $(document).on('change', '#qty', function ()
    {
      const qty = $(this).val();
      var current_url = "{{route('admin.gallery.index')}}";
      window.location.replace(current_url + '?qty=' + qty);

    });


  });
</script>
@endsection