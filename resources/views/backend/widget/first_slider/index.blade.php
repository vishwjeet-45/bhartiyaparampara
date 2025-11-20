@extends('layouts/backend/main')
@section('main-section')

<!-- Page Sidebar Ends-->
  <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Slider First</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Slider First</li> 
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
                                  <option value="10" {{isset($_GET['qty']) && $_GET['qty'] == '10' ? 'selected' : ''}}>10</option>
                                  <option value="20" {{isset($_GET['qty']) && $_GET['qty'] == '20' ? 'selected' : ''}}>20</option>
                                  <option value="50" {{isset($_GET['qty']) && $_GET['qty'] == '50' ? 'selected' : ''}}>50</option>
                                  <option value="100" {{isset($_GET['qty']) && $_GET['qty'] == '100' ? 'selected' : ''}}>100</option>
                                  <option value="250" {{isset($_GET['qty']) && $_GET['qty'] == '250' ? 'selected' : ''}}>250</option>
                                  <option value="500" {{isset($_GET['qty']) && $_GET['qty'] == '500' ? 'selected' : ''}}>500</option>
                              </select>
                            </div>  
                          </div> 
                          <div class="col-md-6">
                          <div class="card-body">
                          <form class="theme-form" method="GET" action="{{URL::full()}}">
                          <div class="form-group d-flex justify-content-end">
                            <input class="form-control" name="search" type="text" placeholder="Search by title" value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
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
                              <th scope="col">URL</th>
                              <th scope="col" >Status</th>
                              <th scope="col" class="d-flex justify-content-center">Action</th>
                            </tr>
                          </thead>
                     @foreach($first_slider_list as $slider)
                     <tr class="{{$slider->status == '0' ? 'tr_disable':'tr_enable'}}">
                              <th scope="row">{{$count++}}</th>
                              <td><img src="{{url('public/build/assets/upload/banner')}}/{{$slider->image}}" width="20%"></td>
                              
                              <td>{{$slider->title}}</td>
                              <td>{{$slider->url}}</td>
                              <td>
                              <div class="form-check form-switch">
                            <input data-id="{{$slider->id}}"  class="form-check-input status_checkbox" type="checkbox" role="switch" id="status_checkbox" {{$slider->status == '1' ? 'checked':''}}>
                           </div>
                            </td>
                              <td class="d-flex justify-content-center">
                                <button value="{{$slider->id}}" class="edit_button btn btn-primary m-r-10" ><i class="fa fa-edit"></i></button>
                                <button value="{{$slider->id}}" class="delete_button btn btn-primary"><i class="fa fa-trash-o"></i></button>
                             
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
                {{$first_slider_list->links('pagination::bootstrap-5')}}<br>   
               </div>
              </div> 
               
            </div>

            @if($first_slider_list->count() == 0)
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
            <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{route('admin.widget.first_slider.store')}}" enctype="multipart/form-data">
              @csrf
            <div class="col-md-12">
              <label class="form-label" for="title">Title</label>
              <input class="form-control" id="title" type="text" name="title" placeholder="Category Name" required="">
            </div>

            <div class="col-md-12">
              <label class="form-label" for="url">Url</label>
              <input class="form-control" id="url" type="text" name="url" placeholder="Category Name" required="">
            </div>

            <div class="col-md-12 mt-3">
              <label class="form-label" for="image">Upload Image</label>
              <input class="form-control" id="image" type="file" name="image" required>
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
        <h5 class="modal-title" id="editModal">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.widget.first_slider.update')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="slider_id" id="slider_id">
          <div class="col-md-12">
            <label class="form-label" for="edit_title">Title</label>
            <input class="form-control" id="edit_title" type="text" name="edit_title"
              placeholder="Category Name" required="">
          </div>

          <div class="col-md-12">
            <label class="form-label" for="edit_url">Url</label>
            <input class="form-control" id="edit_url" type="text" name="edit_url"
              placeholder="Category Name" required="">
          </div>

          <div class="col-md-12 mt-3">
              <label class="form-label" for="edit_image">Image</label>
              <input class="form-control" id="edit_image" type="file" name="edit_image">
            </div>
              
          <div class="col-md-12">
            <label class="form-label" for="edit_status">Select Status</label>
            <select class="form-select" id="edit_status" name="edit_status">
              <option value="1">Active</option>
              <option value="0">InActive</option>
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
@section('javascript-section')
<script>
  // Edit modal setup value
  $(document).ready(function () {
    $(document).on('click', '.edit_button', function () {
      var id = $(this).val();
      $('#editModal').modal('show');
      $.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        data:{'id':id},
        url: "{{route('admin.widget.first_slider.edit')}}",
        success: function (response) {  
          console.log(response.status);
          $('#slider_id').val(response.data.id)
          $('#edit_title').val(response.data.title);
          $('#edit_url').val(response.data.url);
          $("#edit_status").val(response.data.status); 
        }
      });
    });


     // delete request
     $(document).on('click', '.delete_button', function () {
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
      }).then(function (isConfirm) {
        if (isConfirm) {
          $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url: "{{route('admin.widget.first_slider.destroy')}}",
            method: "POST",
            data:{'id':id},
            success: function () {
              swal({
                title: "Success",
                text: "Delete Successfull !",
                icon: "success",
                button: "Ok"
              }).then(function () {
                window.location.reload();
              });
            },
          });
        } else {
          swal("Cancelled", "You dont delete any anything !", "error");
        }
      }) 
    });


    
  }); 


  $(document).on('change', '.status_checkbox', function () {
      var $toggleButton = $(this);
      var status = $toggleButton.prop('checked') ? 1 : 0;
      var id = $(this).data('id'); 

      $.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: "POST",
        url: "{{route('admin.widget.first_slider.update_status')}}",
        data: { 'status': status, 'id': id },
        success: function (data) {
          if (data.status == 200 && data.message == 'success') {
            swal('Status Changed Successfully'); 
            var row = $toggleButton.closest('tr');
            if (status == 1) { 
              row.removeClass('tr_disable');
            } else { 
              row.addClass('tr_disable');
            }
          }
        }
      });
    });


       //  Select Row
       $(document).on('change', '#qty', function () {
      const qty = $(this).val();
      var current_url = "{{route('admin.widget.first_slider.index')}}";
      window.location.replace(current_url + '?qty=' + qty);

    });

    </script>

@endsection
 
@endsection