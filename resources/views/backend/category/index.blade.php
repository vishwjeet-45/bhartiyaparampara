@extends('layouts/backend/main')
@section('main-section')

<!-- Page Sidebar Ends-->
  <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Category</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Category</li> 
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
                            <input class="form-control" name="search" type="text" placeholder="Search Category" value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
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
                              <th scope="col">SNO</th>
                              <th scope="col">Category Name (en)</th>
                              <th scope="col">Category Name (hin)</th>
                              <th scope="col">Main Category</th>
                              <th scope="col" >Status</th>
                              <th scope="col" class="d-flex justify-content-center">Action</th>
                            </tr>
                          </thead>
                          <tbody> 
                            @foreach($c_list as $category) 
                            <tr class="{{$category->category_status == '0' ? 'tr_disable':'tr_enable'}}">
                              <th scope="row">{{$count++}}</th>
                              <td>{{$category->category_name_en}}</td>
                              <td>{{$category->category_name_hi}}</td>
                              <td>{{$category->mainCategory->main_category_name_en}}</td>
                              <td>
                              <div class="form-check form-switch">
                            <input data-id="{{$category->id}}"  class="form-check-input c_status_checkbox" type="checkbox" role="switch" id="c_status_checkbox" {{$category->category_status == '1' ? 'checked':''}}>
                           </div>
                            </td>
                              <td class="d-flex justify-content-center">
                                <button value="{{$category->id}}" class="edit_button btn btn-primary m-r-10" ><i class="fa fa-edit"></i></button>
                                <button value="{{$category->id}}" class="delete_button btn btn-primary"><i class="fa fa-trash-o"></i></button>
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
                  {{$c_list->links('pagination::bootstrap-5')}}<br>
               </div>
              </div> 
               
            </div>

            @if($c_list->count() == 0)
    <div class="pt-4">
    <h5 class="text-center">No Data Available</h5>
    </div>
    @endif
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
<!-- Modal -->
<div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('admin.category.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label class="form-label" for="category_name_en">Category Name (en)</label>
                  <input class="form-control" id="category_name_en" type="text" name="category_name_en"
                    placeholder="Category Name" required="">
                </div>

                <div class="col-md-12 mt-3">
                  <label class="form-label" for="meta_title_en">Meta Title (en)</label>
                  <input class="form-control" id="meta_title_en" type="text" name="meta_title_en"
                    placeholder="Meta Title" required="">
                </div>

                <div class="col-md-12 mt-3">
                  <div class="form-group">
                    <label class="form-label" for="meta_description_en">Meta Description (en)</label>
                    <textarea class="form-control" row="5" col="5" name="meta_description_en" id="meta_description_en"
                      placeholder="Enter Meta Description" required=""></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label" for="category_short_description_en">Short Description (en)</label>
                    <textarea class="form-control" row="5" col="5" name="category_short_description_en"
                      id="category_short_description_en" placeholder="Enter Short Description"></textarea>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label class="form-label" for="category_name_hi">Category Name (hi)</label>
                  <input class="form-control" id="category_name_hi" type="text" name="category_name_hi"
                    placeholder="Category Name" required="">
                </div>

                <div class="col-md-12 mt-3">
                  <label class="form-label" for="meta_title_hi">Meta Title (hi)</label>
                  <input class="form-control" id="meta_title_hi" type="text" name="meta_title_hi"
                    placeholder="Meta Title" required="">
                </div>

                <div class="col-md-12 mt-3">
                  <div class="form-group">
                    <label class="form-label" for="meta_description_hi">Meta Description (hi)</label>
                    <textarea class="form-control" row="5" col="5" name="meta_description_hi" id="meta_description_hi"
                      placeholder="Enter Meta Description" required=""></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label" for="category_short_description_hi">Short Description (hi)</label>
                    <textarea class="form-control" row="5" col="5" name="category_short_description_hi"
                      id="category_short_description_hi" placeholder="Enter Short Description"></textarea>
                  </div>
                </div> 
              </div>
            </div>
          </div> 
          <div class="col-md-12">
            <label class="form-label" for="create_slug">Slug</label>
            <input class="form-control" id="create_slug" type="text" name="create_slug" placeholder="Slug" required="">
            <p style="color:red; font-weight:bold;" id="create_slug_error"></p>
          </div>
          <div class="col-md-12">
            <label class="form-label" for="category_thumbnail">Upload Thumbnail</label>
            <input class="form-control" id="category_thumbnail" type="file" name="category_thumbnail">
          </div>

          <div class="col-md-12">
            <label class="form-label" for="main_category_id">Select Main Category</label>
            <select class="form-select" id="main_category_id" name="main_category_id" required>
              <option selected value="">--Select--</option>
              @foreach($m_c_list as $m_cat)
              <option value="{{$m_cat->id}}">{{$m_cat->main_category_name_en}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-12">
            <label class="form-label" for="category_status">Select Status</label>
            <select class="form-select" id="category_status" name="category_status">
              <option selected value="1">Active</option>
              <option value="0">InActive</option>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="create_submit_btn">Submit</button>
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
        <form action="{{route('admin.category.update')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <input type="hidden" name="category_id" id="category_id">
                <div class="col-md-12">
                  <label class="form-label" for="edit_category_name_en">Category Name (en)</label>
                  <input class="form-control" id="edit_category_name_en" type="text" name="edit_category_name_en"
                    placeholder="Category Name" required="">
                </div>

                <div class="col-md-12 mt-3">
                  <label class="form-label" for="edit_meta_title_en">Meta Title (en)</label>
                  <input class="form-control" id="edit_meta_title_en" type="text" name="edit_meta_title_en"
                    placeholder="Meta Title" required="">
                </div>

                <div class="col-md-12 mt-3">
                  <div class="form-group">
                    <label class="form-label" for="edit_meta_description_en">Meta Description (en)</label>
                    <textarea class="form-control" row="5" col="5" name="edit_meta_description_en"
                      id="edit_meta_description_en" placeholder="Enter Meta Description" required=""></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label" for="edit_category_short_description_en">Short Description (en)</label>
                    <textarea class="form-control" row="5" col="5" name="edit_category_short_description_en"
                      id="edit_category_short_description_en" placeholder="Enter Short Description"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label class="form-label" for="category_name">Category Name (hi)</label>
                  <input class="form-control" id="edit_category_name_hi" type="text" name="edit_category_name_hi"
                    placeholder="Category Name" required="">
                </div>

                <div class="col-md-12 mt-3">
                  <label class="form-label" for="edit_meta_title_hi">Meta Title (hi)</label>
                  <input class="form-control" id="edit_meta_title_hi" type="text" name="edit_meta_title_hi"
                    placeholder="Meta Title" required="">
                </div>

                <div class="col-md-12 mt-3">
                  <div class="form-group">
                    <label class="form-label" for="edit_meta_description_hi">Meta Description (hi)</label>
                    <textarea class="form-control" row="5" col="5" name="edit_meta_description_hi"
                      id="edit_meta_description_hi" placeholder="Enter Meta Description" required=""></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label" for="edit_category_short_description_hi">Short Description (hi)</label>
                    <textarea class="form-control" row="5" col="5" name="edit_category_short_description_hi"
                      id="edit_category_short_description_hi" placeholder="Enter Short Description"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <label class="form-label" for="edit_slug">Slug</label>
            <input class="form-control" id="edit_slug" type="text" name="edit_slug" placeholder="Slug" required="">
            <p style="color:red; font-weight:bold;" id="edit_slug_error"></p>
          </div>


          <div class="col-md-12">
            <label class="form-label" for="edit_category_thumbnail">Upload Thumbnail</label>
            <input class="form-control" id="edit_category_thumbnail" type="file" name="edit_category_thumbnail">
          </div>

          <div class="col-md-12">
            <label class="form-label" for="edit_main_category_id">Select Main Category</label>
            <select class="form-select" id="edit_main_category_id" name="edit_main_category_id" required>
              <option>--Select--</option>
              @foreach($m_c_list as $m_cat)
              <option value="{{$m_cat->id}}">{{$m_cat->main_category_name_en}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-12">
            <label class="form-label" for="category_status">Select Status</label>
            <select class="form-select" id="edit_category_status" name="edit_category_status">
              <option value="1">Active</option>
              <option value="0">InActive</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="removeError()">Close</button>
        <button type="submit" class="btn btn-primary" id="edit_submit_btn">Submit</button>
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

<script>
  // Edit modal setup value
  $(document).ready(function ()
  {
    $(document).on('click', '.edit_button', function ()
    {
      var cat_id = $(this).val();
      $('#editModal').modal('show');
      $.ajax({
        type: "GET",
        url: "category/edit/" + cat_id,
        success: function (response)
        {
          $('#category_id').val(response.cat_detail.id)
          $('#edit_category_name_en').val(response.cat_detail.category_name_en);
          $('#edit_category_name_hi').val(response.cat_detail.category_name_hi);
          $('#edit_meta_title_en').val(response.cat_detail.meta_title_en);
          $('#edit_meta_description_en').val(response.cat_detail.meta_description_en);
          $('#edit_meta_title_hi').val(response.cat_detail.meta_title_hi);
          $('#edit_meta_description_hi').val(response.cat_detail.meta_description_hi);
          $('#edit_category_short_description_en').val(response.cat_detail.category_short_description_en);
          $('#edit_category_short_description_hi').val(response.cat_detail.category_short_description_hi);
          $('#edit_main_category_id').val(response.cat_detail.main_category.id);
          $('#edit_category_status').val(response.cat_detail.category_status);
          $('#edit_slug').val(response.cat_detail.slug);

        }
      });
    });


    // delete category reques
    $(document).on('click', '.delete_button', function ()
    {
      var cat_id = $(this).val();
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
            url: "category/delete/" + cat_id,
            method: "GET",
            success: function (response)
            { 
              if (response.message == 'delete_failed')
              {
                swal({
                  title: "Failed",
                  text: response.error,
                  icon: "error",
                  button: "Ok"
                });
              } else
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

              }

            },
          });
        } else
        {
          swal("Cancelled", "You dont delete any category !", "error");
        }
      })
    });


    $(document).on('change', '.c_status_checkbox', function ()
    {
      var $toggleButton = $(this);
      var category_status = $toggleButton.prop('checked') ? 1 : 0;
      var category_id = $(this).data('id');

      $.ajax({
        type: "GET",
        url: "{{route('admin.category.update_status')}}",
        data: { 'c_status': category_status, 'c_id': category_id },
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
      var current_url = "{{route('admin.category.index')}}";
      window.location.replace(current_url + '?qty=' + qty);
    });


  });
</script>

<script>
$(document).ready(function(){
     $(document).on('keyup', '#edit_slug', function(){
      let slug = $(this).val();
      let id = $('#category_id').val(); 
        $.ajax({
          type: "GET",
              url: "{{route('admin.category.check_edit_slug')}}",
              data: {'id': id, 'slug':slug},
              success: function(response){
                if(response.message == 'slug_exist' && response.status == 400){
                  $('#edit_slug_error').html("slug already in use"); 
                  $('#edit_submit_btn').prop('disabled', true);
                }else{
                  $('#edit_slug_error').html(""); 
                  $('#edit_submit_btn').prop('disabled', false);
                }
               
              }
        });
     });


  $(document).on('keyup', '#create_slug', function(){
      let slug = $(this).val();  
      $.ajax({
          type: "GET",
              url: "{{route('admin.category.check_create_slug')}}",
              data: {'slug':slug},
              success: function(response){
                if(response.message == 'slug_exist' && response.status == 400){
                  $('#create_slug_error').html("slug already in use"); 
                  $('#create_submit_btn').prop('disabled', true);
                }else{
                  $('#create_slug_error').html(""); 
                  $('#create_submit_btn').prop('disabled', false);
                }  
              }
        });
  });

});

function removeError(){
  $('#edit_slug_error').html(""); 
    }
</script>
@endsection