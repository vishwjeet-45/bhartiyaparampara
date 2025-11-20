@extends('layouts/backend/main')
@section('main-section')

  <!-- Page Sidebar Ends-->
  <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>All PDF Pages</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">All PDF  Pages</li> 
                  </ol>
                </div>

                
                <div class="col-sm-6 d-flex justify-content-end"> 
                   <!-- Button trigger modal -->
                <a  class="btn btn-primary" href="{{route('admin.pdf_page.create')}}">Add New</a> 
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
                            <input class="form-control" name="search" type="text" placeholder="Search Page" value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
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
                              <th scope="col">Page Name (en)</th> 
                              <th scope="col">Page Name (hi)</th>   
                              <th scope="col" >Status</th>
                              <th scope="col" class="d-flex justify-content-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>  
                            @foreach($pdf_page_list as $page) 
                            <tr class="{{$page->page_status == '0' ? 'tr_disable':'tr_enable'}}">
                              <td scope="row">{{$count++}}</td>
                              <td>{{$page->page_name_en}}</td> 
                              <td>{{$page->page_name_hi}}</td>  
                               <td>
                              <div class="form-check form-switch">
                            <input data-id="{{$page->id}}"  class="form-check-input pdf_page_status" type="checkbox" role="switch" id="pdf_page_status" {{$page->page_status == '1' ? 'checked':''}}>
                           </div>
                            </td>
                              <td class="d-flex justify-content-center">
                                <a value="{{$page->id}}" href="{{route('admin.pdf_page.edit', [$page->id])}}" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></a>
                                <button value="{{$page->id}}" class="delete_button btn btn-primary"><i class="fa fa-trash-o"></i></button>
                             
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
                  {{$pdf_page_list->links('pagination::bootstrap-5')}}<br>
               </div>
                <div>
                  
               </div>
              </div> 
               
            </div>

            @if($pdf_page_list->count() == 0)
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
     

<!-- Edit Modal -->
 
 
 
@section('javascript-section') 
@if(Session::has('pdf_page_success'))
<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Success",
            text: "{{(Session::get('pdf_page_success'))}}"  ,
            icon: "success",
            button: "Ok"
        });
    });
</script>
@elseif(Session::has('pdf_page_fail'))
<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Failed",
            text: "{{(Session::get('pdf_page_fail'))}}",
            icon: "error",
            button: "Ok"
        });
    }); 
</script>
@endif 

@if(Session::has('pdf_page_update_success'))
<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Success",
            text: "{{(Session::get('pdf_page_update_success'))}}"  ,
            icon: "success",
            button: "Ok"
        });
    });
</script>
@elseif(Session::has('pdf_page_update_fail'))
<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Failed",
            text: "{{(Session::get('pdf_page_update_fail'))}}",
            icon: "error",
            button: "Ok"
        });
    }); 
</script>
@endif 
<script>
$(document).on('change', '.pdf_page_status', function () {
      var $toggleButton = $(this);
      var pdf_page_status = $toggleButton.prop('checked') ? 1 : 0;
      var pdf_page_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        url: "{{route('admin.pdf_page.update_status')}}",
        data: { 'pdf_page_status': pdf_page_status, 'pdf_page_id': pdf_page_id },
        success: function (data) {
          console.log('test');
          if (data.status == 200 && data.message == 'status_updated') {
            swal('Status Changed Successfully');
            // Change the row color based on the button's status
            var row = $toggleButton.closest('tr');
            if (pdf_page_status == 1) {
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



     // delete Page request
     $(document).on('click', '.delete_button', function () {
      var pdf_page_id = $(this).val();
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
            url: "pdf-page/destroy/" + pdf_page_id,
            method: "GET",
            success: function () {
              swal({
                title: "Success",
                text: "Page has been deleted !",
                icon: "success",
                button: "Ok"
              }).then(function () {
                window.location.reload();
              });
            },
          });
        } else {
          swal("Cancelled", "You dont delete any page !", "error");
        }
      })


    });
  </script>
@endsection
@endsection