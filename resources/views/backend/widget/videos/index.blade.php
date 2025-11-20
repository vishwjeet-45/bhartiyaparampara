@extends('layouts/backend/main')
@section('main-section')

<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Video Section</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Video Section</li>
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
                        <input class="form-control" name="search" type="text" placeholder="Search by title" value="">
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
                      <th scope="col">Title(en)</th>
                      <th scope="col">Title(hi)</th>
                      <th scope="col">File Type</th>
                      <th scope="col">Status</th>
                      <th scope="col" class="d-flex justify-content-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($video_list as $video)
                    <tr class="{{$video->status == '0' ? 'tr_disable':'tr_enable'}}">
                      <th scope="row">{{$count++}}</th>
                      <td>{{$video->title_en}}</td>
                      <td>{{$video->title_hi}}</td>
                      <td>
                        @if($video->type == 'url') 
                         <a href="{{$video->video_link}}" target="_blank"><img src="{{url('')}}/{{$video->thumbnail}}" alt="" style="width:300px"></a>
                        @elseif($video->type == 'file')
                        <a href="{{url('')}}/{{$video->video_link}}" target="_blank"><img src="{{url('')}}/{{$video->thumbnail}}" alt="" style="width:300px"></a>
                        @endif
                      </td>
                      <td>
                        <div class="form-check form-switch">
                          <input data-id="{{$video->id}}" class="form-check-input status_checkbox" type="checkbox" role="switch"
                            id="status_checkbox" {{$video->status == '1'?'checked':''}}>
                        </div>
                      </td>
                      <td class="d-flex justify-content-center">
                        <button value="{{$video->id}}" class="edit_button btn btn-primary m-r-10"><i
                            class="fa fa-edit"></i></button>
                        <button value="{{$video->id}}" class="delete_button btn btn-primary"><i
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
          {{$video_list->links('pagination::bootstrap-5')}}<br>
        </div>
        <div>
          <br>
        </div>
      </div>

    </div>

    @if($video_list->count() == 0)
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
        <ul class="nav nav-tabs border-tab mb-0" id="top-tab" role="tablist">
          <li class="nav-item"><a class="nav-link active " id="top-home-tab" data-bs-toggle="tab" href="#top-home"
              role="tab" aria-controls="top-home" aria-selected="false" data-bs-original-title="" title="">Upload
              Video</a>
            <div class="material-border"></div>
          </li>
          <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile"
              role="tab" aria-controls="top-profile" aria-selected="false" data-bs-original-title="" title="">Insert
              Url</a>
            <div class="material-border"></div>
          </li>
        </ul>

        <div class="tab-content" id="top-tabContent">
          <div class="tab-pane fade active show" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
            <form action="{{route('amdin.widget.video_section.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="col-md-12">
                <label class="form-label pt-4 pb-2" for="title">Title(hi)</label>
                <input class="form-control" id="title_hi" type="text" name="title_hi" placeholder="Enter File Title"
                  required="">
              </div>
              <div class="col-md-12">
                <label class="form-label pt-4 pb-2" for="title">Title(en)</label>
                <input class="form-control" id="title_en" type="text" name="title_en" placeholder="Enter File Title"
                  required="">
              </div>
              <div class="col-md-12 mt-3">
                <label class="form-label  my-1" for="video_file">Upload Video File</label>
                <input class="form-control my-1" id="video_file" type="file" name="video_file" required="">
                <label class="form-label my-1 " for="thumbnail">Thumbnail</label>
                <input class="form-control my-1" id="thumbnail" type="file" name="thumbnail" required="">
                
              </div>
              <input type="hidden" value="file" name="type">
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

          <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
            <form action="{{route('amdin.widget.video_section.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="col-md-12">
                <label class="form-label pt-4 pb-2" for="title">Title(hi)</label>
                <input class="form-control" id="title_hi" type="text" name="title_hi" placeholder="Enter File Title"
                  required="">
              </div>
              <div class="col-md-12">
                <label class="form-label pt-4 pb-2" for="title">Title(en)</label>
                <input class="form-control" id="title_en" type="text" name="title_en" placeholder="Enter File Title"
                  required="">
              </div>
              <div class="col-md-12 mt-3">
                <label class="form-label  pb-2" for="video_url">Insert Video Url</label>
                <input class="form-control" id="video_url" type="url" name="video_url" required="">
                <label class="form-label my-1 " for="thumbnail">Thumbnail</label>
                <input class="form-control my-1" id="thumbnail" type="file" name="thumbnail" required="">
              </div>
              <input type="hidden" value="url" name="type">
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>
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
        <ul class="nav nav-tabs border-tab mb-0" id="top-tab2" role="tablist">
          <li class="nav-item"><a class="nav-link active" id="top-edit-upload_tab" data-bs-toggle="tab" href="#edit_upload_tab"
              role="tab" aria-controls="top-edit-upload" aria-selected="false" data-bs-original-title="" title="">Upload
              Video</a>
            <div class="material-border"></div>
          </li>
          <li class="nav-item"><a class="nav-link" id="top_edit_url_tab" data-bs-toggle="tab" href="#edit_url_tab"
              role="tab" aria-controls="edit_url_tab" aria-selected="false" data-bs-original-title="" title="">Insert
              Url</a>
            <div class="material-border"></div>
          </li>
        </ul>

        <div class="tab-content" id="top-tabContent">
          <div class="tab-pane fade active show" id="edit_upload_tab" role="tabpanel" aria-labelledby="top-edit-upload_tab">
            <form action="{{route('admin.widget.video_section.update')}}" method="POST" enctype="multipart/form-data" id="edit_upload_form">
              @csrf
              <input type="hidden" value="file" name="type">
              <input type="hidden" name="row_id" id="upload_tab_row_id">
              <div class="col-md-12">
                <label class="form-label pt-4 pb-2" for="edit_upload_title">Title(hi)</label>
                <input class="form-control" id="edit_upload_title_hi" type="text" name="edit_upload_title_hi" placeholder="Enter File Title"
                  required="">
              </div>
              <div class="col-md-12">
                <label class="form-label pt-4 pb-2" for="edit_upload_title">Title(en)</label>
                <input class="form-control" id="edit_upload_title_en" type="text" name="edit_upload_title_en" placeholder="Enter File Title"
                  required="">
              </div>
              <div class="col-md-12 mt-3"> 
                  <label class="form-label my-1 " for="edit_upload_video_file">Upload Video File</label>
                  <input class="form-control my-1" id="edit_upload_video_file" type="file" name="edit_upload_video_file">
                  <label class="form-label my-1" for="edit_upload_thumbnail">Upload Image File</label>
                  <input class="form-control my-1" id="edit_upload_thumbnail" type="file" name="edit_upload_thumbnail">
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

          <div class="tab-pane fade" id="edit_url_tab" role="tabpanel" aria-labelledby="edit_url_tab">
            <form action="{{route('admin.widget.video_section.update')}}" method="POST" enctype="multipart/form-data" id="edit_url_form">
              @csrf
              <input type="hidden" value="url" name="type">
              <input type="hidden" name="row_id" id="url_tab_row_id">
              <div class="col-md-12">
                <label class="form-label pt-4 pb-2" for="edit_url_title">Title(hi)</label>
                <input class="form-control" id="edit_url_title_hi" type="text" name="edit_url_title_hi" placeholder="Enter File Title"
                  required="">
              </div>
              <div class="col-md-12">
                <label class="form-label pt-4 pb-2" for="edit_url_title">Title(en)</label>
                <input class="form-control" id="edit_url_title_en" type="text" name="edit_url_title_en" placeholder="Enter File Title"
                  required="">
              </div>
              <div class="col-md-12 mt-3">
                <label class="form-label  pb-2" for="edit_video_url">Insert Url</label>
                <input class="form-control" id="edit_video_url" type="url" name="edit_video_url" placeholder="Enter video url">
              </div>
              <div class="my-3" >
                <label class="form-label  pb-2" for="edit_url_thumbnail">Thumbnail</label>
                    <input class="form-control" type="file" id="edit_url_thumbnail" name="edit_url_thumbnail" placeholder="Enter image URL">
              </div>
             
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>
      </div>

      </form>
    </div>
  </div>
</div> 
@endsection 
@section('javascript-section')
@if(Session::has('created'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Done",
      text: "{{(Session::get('created'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif 
@if(Session::has('updated'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Done",
      text: "{{(Session::get('updated'))}}",
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
      var id = $(this).val();
      $('#editModal').modal('show');
      $.ajax({
        type: "GET",
        url: "{{route('admin.widget.video_section.edit')}}",
        data: { 'id': id },
        success: function (response)
        {
          if(response.type == 'file'){
            $('#edit_upload_title_hi').val(response.title_hi); 
            $('#edit_upload_title_en').val(response.title_en); 
            $('#upload_tab_row_id').val(response.id); 
            $('#edit_url_form').trigger("reset");

            $('#top-edit-upload_tab').addClass("active");
            $('#top_edit_url_tab').removeClass("active"); 
            $('#edit_upload_tab').addClass("active show");
            $('#edit_url_tab').removeClass("active show");
           
            
            
          }else if(response.type == 'url'){
            $('#edit_url_title_hi').val(response.title_hi); 
            $('#edit_url_title_en').val(response.title_en); 
            $('#edit_video_url').val(response.video_link);
            $('#url_tab_row_id').val(response.id);
            $('#edit_upload_form').trigger("reset"); 

            $('#top-edit-upload_tab').removeClass("active");
            $('#top_edit_url_tab').addClass("active");
            $('#edit_upload_tab').removeClass("active show");
            $('#edit_url_tab').addClass("active show");
          }
          

        }
      });
    });


    // delete category reques
    $(document).on('click', '.delete_button', function ()
    {
      var id = $(this).val();
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
            url: "{{route('amdin.widget.video_section.destroy')}}",
            data: { 'id': id },
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
    $(document).on('change', '.status_checkbox', function ()
    {
      var $toggleButton = $(this);
      var status = $toggleButton.prop('checked') ? 1 : 0;
      var id = $(this).data('id');

      $.ajax({
        type: "GET",
        url: "{{route('admin.widget.video_section.update_status')}}",
        data: { 'status': status, 'id': id },
        success: function (data)
        {
          if (data.status == 200 && data.message == 'status_updated')
          {
            swal('Status Changed Successfully');
            // Change the row color based on the button's status
            var row = $toggleButton.closest('tr');
            if (status == 1)
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
      var current_url = "{{route('amdin.widget.video_section.index')}}";
      window.location.replace(current_url + '?qty=' + qty);

    }); 
  });
</script>

@endsection