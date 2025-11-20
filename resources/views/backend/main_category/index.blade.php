@extends('layouts/backend/main')
@section('main-section')

<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Main Category</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Main Category</li>
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
                <div class="col-md-9">
                  <div class="card-body d-flex" >
                    <label class="col-form-label">Row:</label>
                    <select class="js-example-basic-single col-sm-4" name="qty" id="qty">
                      <option value="10" {{isset($_GET['qty']) && $_GET['qty']=='10' ? 'selected' : '' }}>10</option>
                      <option value="20" {{isset($_GET['qty']) && $_GET['qty']=='20' ? 'selected' : '' }}>20</option>
                      <option value="50" {{isset($_GET['qty']) && $_GET['qty']=='50' ? 'selected' : '' }}>50</option>
                      <option value="100" {{isset($_GET['qty']) && $_GET['qty']=='100' ? 'selected' : '' }}>100</option>
                      <option value="250" {{isset($_GET['qty']) && $_GET['qty']=='250' ? 'selected' : '' }}>250</option>
                      <option value="500" {{isset($_GET['qty']) && $_GET['qty']=='500' ? 'selected' : '' }}>500</option>
                    </select>

                    <form class="theme-form d-flex mx-3" method="GET" action="{{URL::full()}}">
                      <label class="col-form-label">Select Type:</label>
                      <select class="js-example-basic-single col-sm-4" name="post_type" id="post_type">
                        <option value="">All Type</option>
                        <option value="0" {{isset($_GET['post_type']) && $_GET['post_type']=='0' ? 'selected' : '' }}>
                        Dropdown Menu</option>
                        <option value="1" {{isset($_GET['post_type']) && $_GET['post_type']=='1' ? 'selected' : '' }}>
                          Mega Menu</option>
                        <option value="2" {{isset($_GET['post_type']) && $_GET['post_type']=='2' ? 'selected' : '' }}>
                          Page</option>
                        <option value="3" {{isset($_GET['post_type']) && $_GET['post_type']=='3' ? 'selected' : '' }}>
                          Top Header Menu</option>
                        <option value="4" {{isset($_GET['post_type']) && $_GET['post_type']=='4' ? 'selected' : '' }}>
                        Main Category</option>
                      </select>
                      <button type="submit" class="btn btn-primary">Apply Filter</button>
                    </form>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card-body">
                    <form class="theme-form" method="GET" action="{{URL::full()}}">
                      <div class="form-group d-flex justify-content-end">
                        <input class="form-control"  name="search" type="text" placeholder="Search Category"
                          value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}" style="width:155px;">
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                    </form>
                  </div>
                </div> 
              </div>

              <div class="table-responsive"> 
                @php
                if(isset($_GET['page'])){
                $page_number = $_GET['page'];
                }else{
                $page_number = 1;
                }

                $count = $page_number * 10 - 9;
                @endphp
                
                <table class="table">
                  <thead class="bg-primary">
                    <tr>
                      <th scope="col">S.NO</th>
                      <th scope="col">Name (eng)</th>
                      <th scope="col">Name (hin)</th>
                      <th scope="col">Category Type</th>
                      <th scope="col">Status</th>
                      <th scope="col">Order No</th>
                      <th scope="col" class="d-flex justify-content-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($m_c_list as $category)
                    <tr class="{{$category->main_category_status == '0' ? 'tr_disable':'tr_enable'}}">
                      <th scope="row">{{$count++}}</th>
                      <td>{{$category->main_category_name_en}}</td>
                      <td>{{$category->main_category_name_hi}}</td>
                      <td>
                        @if($category->page_type == 0)
                        Dropdown Menu
                        @elseif($category->page_type == 1)
                        Mega Menu
                        @elseif($category->page_type == 2)
                        Page
                        @elseif($category->page_type == 3)
                        Top Header Menu
                        @elseif($category->page_type == 4)
                        Main Category
                        @endif
                      </td>

                      


                      <td>
                        <div class="form-check form-switch">
                          <input data-id="{{$category->id}}" class="form-check-input m_c_status_checkbox"
                            type="checkbox" role="switch" id="m_c_status_checkbox" {{$category->main_category_status ==
                          '1' ? 'checked':''}}>
                        </div>
                      </td>
                      <td>{{$category->order_number}}</td>

                      <td class="d-flex justify-content-center">
                        <button value="{{$category->id}}" class="edit_button btn btn-primary m-r-10"><i
                            class="fa fa-edit"></i></button>
                        <button value="{{$category->id}}" class="delete_button btn btn-primary"><i
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
          {{$m_c_list->links('pagination::bootstrap-5')}}<br>
        </div>
      </div>

    </div>
    @if($m_c_list->count() == 0)
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
        <h5 class="modal-title" id="exampleModalLabel">Add Main Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('admin.main_category.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label class="form-label" for="main_category_name_en">Main Category Name (en)</label>
                  <input class="form-control" id="main_category_name_en" type="text" name="main_category_name_en"
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
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label class="form-label" for="main_category_name_hi">Main Category Name (hi)</label>
                  <input class="form-control" id="main_category_name_hi" type="text" name="main_category_name_hi"
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
              </div>
            </div>
          </div>

          <div class="col-md-12 mt-3">
            <label class="form-label" for="main_category_status">Select Status</label>
            <select id="main_category_status" name="main_category_status"
              style="display: block;  width: 100%; padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; border-color: #ef402947;"
              onfocus="this.style.borderColor='#ecf3fa';" onchange="handleSelectChange(this);">
              <option selected value="1">Active</option>
              <option value="0">InActive</option>
            </select>
          </div>

          <div class="col-md-12 mt-3">
            <label class="form-label" for="main_category_is_page">Select Type</label>
            <select id="main_category_is_page" name="main_category_is_page"
              style="display: block;  width: 100%; padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; border-color: #ef402947;"
              onfocus="this.style.borderColor='#ecf3fa';" onchange="handleSelectChange(this);">
              <option selected value="0">Dropdown Menu</option>
              <option value="1">Mega Menu</option>
              <option value="2">Page</option>
              <option value="3">Top Header Menu</option>
              <option value="4">Main Category</option>
            </select>
          </div>
          <div class="col-md-12 mt-3">
            <label class="form-label" for="slug">Slug</label>
            <input class="form-control" id="create_slug" type="text" name="slug" min="1" placeholder="Slug" required="">
          </div> 
          <p style="color:red; font-weight:bold;" id="create_slug_error"></p>

          <div class="col-md-12 mt-3">
            <label class="form-label" for="main_category_is_page">Order Number</label>
            <input class="form-control" id="order_number" type="number" name="order_number" min="1" placeholder="Order Number" required="">
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
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Main Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.main_category.update')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <input type="hidden" name="main_category_id" id="main_category_id">
                <input type="hidden" name="page_type" id="page_type">
                <div class="col-md-12">
                  <label class="form-label" for="main_category_name">Main Category Name (en)</label>
                  <input class="form-control" id="edit_main_category_name_en" type="text"
                    name="edit_main_category_name_en" placeholder="Category Name" required="">
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
                      id="edit_meta_description_en" placeholder="Enter Meta Description (en)" required=""></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <label class="form-label" for="main_category_name">Main Category Name (hi)</label>
                  <input class="form-control" id="edit_main_category_name_hi" type="text"
                    name="edit_main_category_name_hi" placeholder="Category Name" required="">
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

                

              </div>
            </div>
          </div>


          <div class="col-md-12">
            <label class="form-label" for="edit_main_category_thumbnail">Update Thumbnail</label>
            <input class="form-control" id="edit_main_category_thumbnail" type="file"
              name="edit_main_category_thumbnail">
          </div>

          <div class="col-md-12">
            <label class="form-label" for="main_category_status">Select Status</label>
            <select class="form-select" id="edit_main_category_status" name="edit_main_category_status">
              <option value="1">Active</option>
              <option value="0">InActive</option>
            </select>
          </div>

          <div class="col-md-12 mt-3">
            <label class="form-label" for="main_category_is_page">Order Number</label>
            <input class="form-control" id="edit_order_number" type="number" name="edit_order_number" min="1" placeholder="Order Number" required="">
          </div>
          <div class="col-md-12 mt-3">
            <label class="form-label" for="edit_slug">Slug</label>
            <input class="form-control" id="edit_slug" type="text" name="edit_slug" min="1" placeholder="Slug" required="">
          </div> 
          <p style="color:red; font-weight:bold;" id="slug_error"></p>
        

          <!--             
            <div class="col-md-12 mt-3">
              <label class="form-label" for="edit_main_category_page_type">Select Type</label>
              <select class="form-control" id="edit_main_category_page_type" name="edit_main_category_page_type"> 
                <option value="0">Main Category</option>
                <option value="1">Mega Menu</option> 
                <option value="2">Page</option> 
              </select>
            </div>  -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="removeError()" data-bs-dismiss="modal">Close</button>
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
  $(document).ready(function () {
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
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('faild'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('hindi_exist'))
<script type="text/javascript">
  $(document).ready(function () {
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
  $(document).ready(function () {
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
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('already_exist'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('slug_exist'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('slug_exist'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif

@if(Session::has('update_success'))
<script type="text/javascript">
  $(document).ready(function () {
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
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('update_failed'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>

@elseif(Session::has('used_in_post'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('used_in_post'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif

<script>
$(document).ready(function(){
     $(document).on('keyup', '#edit_slug', function(){
      let slug = $(this).val();
      let id = $('#main_category_id').val();
      let page_type = $('#page_type').val();
        $.ajax({
          type: "GET",
              url: "{{route('admin.main_category.check_edit_slug')}}",
              data: {'id': id, 'slug':slug, 'page_type':page_type},
              success: function(response){
                if(response.message == 'slug_exist' && response.status == 400){
                  $('#slug_error').html("slug already in use"); 
                  $('#edit_submit_btn').prop('disabled', true);
                }else{
                  $('#slug_error').html(""); 
                  $('#edit_submit_btn').prop('disabled', false);
                } 
              }
        });
     });


  $(document).on('keyup', '#create_slug', function(){
      let slug = $(this).val();  
      $.ajax({
          type: "GET",
              url: "{{route('admin.main_category.check_create_slug')}}",
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
  $('#slug_error').html(""); 
    }
</script>
<script>
  // Edit modal setu value
  $(document).ready(function () {
    $(document).on('click', '.edit_button', function () {
      var main_cat_id = $(this).val();
      $('#editModal').modal('show');
      $.ajax({
        type: "GET",
        url: "main-category/edit/" + main_cat_id,
        success: function (response) {
          $('#main_category_id').val(response.main_cat_detail.id)
          $('#edit_main_category_name_en').val(response.main_cat_detail.main_category_name_en);
          $('#edit_main_category_name_hi').val(response.main_cat_detail.main_category_name_hi);
          $('#edit_meta_title_en').val(response.main_cat_detail.meta_title_en);
          $('#edit_meta_description_en').val(response.main_cat_detail.meta_description_en);
          $('#edit_meta_title_hi').val(response.main_cat_detail.meta_title_hi);
          $('#edit_meta_description_hi').val(response.main_cat_detail.meta_description_hi);
          // $("#edit_main_category_page_type").val(response.main_cat_detail.page_type); 
          $("#edit_main_category_status").val(response.main_cat_detail.main_category_status);
          $("#edit_main_category_short_description").val(response.main_cat_detail.main_category_short_description);
          $("#edit_order_number").val(response.main_cat_detail.order_number);
          $("#edit_slug").val(response.main_cat_detail.slug);
          $("#page_type").val(response.main_cat_detail.page_type);
        }
      });
    });

    $(document).on('click', '.delete_button', function () {
      var main_cat_id = $(this).val();
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
          $.ajax({
            url: "main-category/delete/" + main_cat_id,
            method: "GET",
            success: function (response) {
              console.log(response);
              if (response.status == 400 && response.message == 'used_in_post') {
                swal({
                  title: "Warning",
                  text: "This category is in used please remove first !",
                  icon: "warning",
                  button: "Ok"
                })
              } else if (response.status == 200) {
                swal({
                  title: "Success",
                  text: "Main Category has been deleted !",
                  icon: "success",
                  button: "Ok"
                }).then(function () {
                  window.location.reload();
                });
              }
            },
          });
        } else {
          swal("Cancelled", "You dont delete any category !", "error");
        }
      })


    });


    $(document).on('change', '.m_c_status_checkbox', function () {
      var $toggleButton = $(this);
      var m_category_status = $toggleButton.prop('checked') ? 1 : 0;
      var m_category_id = $(this).data('id');

      $.ajax({
        type: "GET",
        url: "{{route('admin.main_category.update_status')}}",
        data: { 'm_c_status': m_category_status, 'm_c_id': m_category_id },
        success: function (data) {
          if (data.status == 200 && data.message == 'status_updated') {
            swal('Status Changed Successfully');
            // Change the row color based on the button's status
            var row = $toggleButton.closest('tr');
            if (m_category_status == 1) {
              // Enable the row (remove the disabled class)
              row.removeClass('tr_disable');
            } else {
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
      var current_url = "{{route('admin.main_category.index')}}";
      window.location.replace(current_url + '?qty=' + qty);

    });


  });
</script>
<script>
  function handleSelectChange(selectElement) {
    // Your logic for handling the selection change
    console.log("Selected option: ", selectElement.value);
  }

  document.getElementById('main_category_is_page').addEventListener('keydown', function (e) {
    // Check if the pressed key is an arrow key
    if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
      e.preventDefault(); // Prevent the default behavior of arrow keys in the select element

      // Get the options and the currently selected index
      var options = Array.from(e.target.options);
      var currentIndex = options.findIndex(option => option.selected);

      // Calculate the new index based on the arrow key pressed
      var newIndex;
      if (e.key === 'ArrowUp') {
        newIndex = (currentIndex - 1 + options.length) % options.length;
      } else {
        newIndex = (currentIndex + 1) % options.length;
      }

      // Update the selected option and trigger the change event
      options[newIndex].selected = true;
      handleSelectChange(e.target);
    }
  });
</script>
@endsection