@extends('layouts/backend/main')
@section('main-section')

<style>
#pdf-if span{
    width: 98.6094px;
}
#pdf-if .select2-container--default .select2-selection--single .select2-selection__arrow{

      right: -35px !important;
}
</style>
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Upload Pdf</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Upload Pdf</li>
          </ol>
        </div>


        <div class="col-sm-6 d-flex justify-content-end">
          <!-- Button trigger modal -->
          <a href="{{route('admin.upload_pdf.create')}}" class="btn btn-primary">Add New</a>
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
                <div class="col-md-8">
                  <div class="card-body d-flex">
                    <label class="col-form-label">Row:</label>
                    <select class="js-example-basic-single col-sm-4" name="qty" id="qty">
                      <option value="10" {{isset($_GET['qty']) && $_GET['qty']=='10' ? 'selected' : '' }}>10</option>
                      <option value="20" {{isset($_GET['qty']) && $_GET['qty']=='20' ? 'selected' : '' }}>20</option>
                      <option value="50" {{isset($_GET['qty']) && $_GET['qty']=='50' ? 'selected' : '' }}>50</option>
                      <option value="100" {{isset($_GET['qty']) && $_GET['qty']=='100' ? 'selected' : '' }}>100</option>
                      <option value="250" {{isset($_GET['qty']) && $_GET['qty']=='250' ? 'selected' : '' }}>250</option>
                      <option value="500" {{isset($_GET['qty']) && $_GET['qty']=='500' ? 'selected' : '' }}>500</option>
                    </select>

                    <label class="col-form-label mx-2">Select Page:</label>
                    <form action="{{URL::full()}}" method="GET" style="display:flex" id="pdf-if">
                      <select class="js-example-basic-single col-sm-4" name="pdf_page" id="pdf_page">
                        <option value="">All Pages</option>
                        @foreach($pdf_page_list as $page)
                        <option value="{{$page->id}}" {{isset($_GET['pdf_page']) && $_GET['pdf_page']==$page->id ?
                          'selected' : ''}}>{{$page->page_name_en}}</option>
                        @endforeach
                      </select>
                      <button type="submit" class="btn btn-primary">Apply Filter</button>
                        </form>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card-body d-flex ">
                    

                        <form class="theme-form" method="GET" action="{{URL::full()}}">
                          <div class="form-group d-flex justify-content-end">
                            <input class="form-control" name="search" type="text" placeholder="Search by title"
                              value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
                            <button type="submit" class="btn btn-primary">Search</button>
                          </div>
                        </form>
                  </div>
                </div>

                <!-- <div class="col-md-4">
                  <div class="card-body">
                    
                  </div>
                </div> -->
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
                      <th scope="col">File Title (hi)</th>
                      <th scope="col">File Title (en)</th>
                      <th scope="col">Date</th>
                      <!--<th scope="col">Language</th>-->
                      <th scope="col">Status</th>
                      <th scope="col" class="d-flex justify-content-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pdf_file_list as $pdf_file)
                    <tr class="{{$pdf_file->file_status == '0' ? 'tr_disable':'tr_enable'}}">
                      <th scope="row">{{$count++}}</th>
                      <td>{{$pdf_file->pdf_file_title_hi}}</td>
                       <td>{{$pdf_file->pdf_file_title_en}}</td>
                       <td>{{ \Carbon\Carbon::parse($pdf_file->created_at)->format('d M, Y') }}</td>
                      <!--<td>{{$pdf_file->file_language}}</td>-->
                      <td>
                        <div class="form-check form-switch">
                          <input data-id="{{$pdf_file->id}}" class="form-check-input pdf_file_status_checkbox"
                            type="checkbox" role="switch" id="pdf_file_status_checkbox" {{$pdf_file->file_status == '1'
                          ? 'checked':''}}>
                        </div>
                      </td>
                      <td class="d-flex justify-content-center">
                        <a href="{{route('admin.upload_pdf.edit', [$pdf_file->id])}}"
                          class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></a>
                        <button value="{{$pdf_file->id}}" class="delete_button btn btn-primary"><i
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
          {{$pdf_file_list->links('pagination::bootstrap-5')}}<br>
        </div> 
      </div>

    </div>

    @if($pdf_file_list->count() == 0)
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
@if(Session::has('file_upload_success'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('file_upload_success'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif

@if(Session::has('file_update_success'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('file_update_success'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif



<script>
  $(document).on('change', '.pdf_file_status_checkbox', function ()
  {
    var $toggleButton = $(this);
    var pdf_file_status = $toggleButton.prop('checked') ? 1 : 0;
    var pdf_file_id = $(this).data('id');

    $.ajax({
      type: "GET",
      url: "{{route('admin.upload_pdf.update_status')}}",
      data: { 'pdf_file_status': pdf_file_status, 'pdf_file_id': pdf_file_id },
      success: function (data)
      {
        if (data.status == 200 && data.message == 'status_updated')
        {
          swal('Status Changed Successfully');
          // Change the row color based on the button's status
          var row = $toggleButton.closest('tr');
          if (pdf_file_status == 1)
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


  $(document).on('click', '.delete_button', function ()
  {
    var pdf_file_id = $(this).val();
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
          url: "upload_pdf/destroy/" + pdf_file_id,
          method: "GET",
          success: function ()
          {
            swal({
              title: "Success",
              text: "File has been deleted !",
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
        swal("Cancelled", "You dont delete any File !", "error");
      }
    })
  });




  $(document).on('change', '#qty', function ()
  {
    const qty = $(this).val();
    var current_url = "{{route('admin.upload_pdf.index')}}";
    window.location.replace(current_url + '?qty=' + qty);

  });

</script>

@endsection
@endsection