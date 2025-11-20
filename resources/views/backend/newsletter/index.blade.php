@extends('layouts/backend/main')
@section('main-section')

<!-- Page Sidebar Ends-->
  <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Newsletter</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Newsletter</li> 
                  </ol>
                </div> 
                <div class="col-sm-6 d-flex justify-content-end"> 
                   <!-- Button trigger modal -->
                <a type="button" class="btn btn-primary" href="{{route('admin.newsletter.create')}}">
                  Add New
                </a> 
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
                            <input class="form-control" name="search" type="text" placeholder="Search by email" value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
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
                              <th scope="col">Email Id</th> 
                              <th scope="col" >Status</th>
                              <th scope="col" class="d-flex justify-content-center">Action</th>
                            </tr>
                          </thead>
                          <tbody> 
                            @foreach($newsletter_list as $newsletter) 
                            <tr class="{{$newsletter->status == '0' ? 'tr_disable':'tr_enable'}}">
                              <th scope="row">{{$count++}}</th>
                              <td>{{$newsletter->email}}</td> 
                              <td>
                              <div class="form-check form-switch">
                            <input data-id="{{$newsletter->id}}"  class="form-check-input n_status_checkbox" type="checkbox" role="switch" id="n_status_checkbox" {{$newsletter->status == '1' ? 'checked':''}}>
                           </div>
                            </td>
                              <td class="d-flex justify-content-center">
                                <button value="{{$newsletter->id}}" class="delete_button btn btn-primary"><i class="fa fa-trash-o"></i></button>
                             
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
                  {{$newsletter_list->links('pagination::bootstrap-5')}}<br>
               </div>
              </div> 
               
            </div>

            @if($newsletter_list->count() == 0)
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
@endif

@if(Session::has('mail_sent'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Success",
      text: "{{(Session::get('mail_sent'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif



<!-- some error accured when submit -->
@if(Session::has('error'))
<script type="text/javascript">
  $(document).ready(function () {
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
  $(document).ready(function () { 

    // delete category reques
    $(document).on('click', '.delete_button', function () {
      var n_id = $(this).val();
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
            url: "newsletter/destroy/" + n_id,
            method: "GET",
            success: function () {
              swal({
                title: "Success",
                text: "Category has been deleted !",
                icon: "success",
                button: "Ok"
              }).then(function () {
                window.location.reload();
              });
            },
          });
        } else {
          swal("Cancelled", "You dont delete any category !", "error");
        }
      }) 
    });


    $(document).on('change', '.n_status_checkbox', function () {
      var $toggleButton = $(this);
      var newsletter_status = $toggleButton.prop('checked') ? 1 : 0;
      var newsletter_id = $(this).data('id');

      $.ajax({
        type: "GET",
        url: "{{route('admin.newsletter.update_status')}}",
        data: { 'newsletter_status': newsletter_status, 'newsletter_id': newsletter_id },
        success: function (data) {
          if (data.status == 200 && data.message == 'status_updated') {
            swal('Status Changed Successfully');
            // Change the row color based on the button's status
            var row = $toggleButton.closest('tr');
            if (newsletter_status == 1) {
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
      var current_url = "{{route('admin.newsletter.index')}}";
      window.location.replace(current_url + '?qty=' + qty);

    });


  });
</script>
@endsection