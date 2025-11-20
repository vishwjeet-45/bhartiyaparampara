@extends('layouts/backend/main')
@section('main-section')

  <!-- Page Sidebar Ends-->
  <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Menu Pages</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Menu Pages</li> 
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
                              <th scope="col">Page Name</th> 
                              <th scope="col">Language</th> 
                              <!-- <th scope="col">Is Category</th> -->
                              <th scope="col" >Status</th>
                              <th scope="col" class="d-flex justify-content-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>  
                            @foreach($page_list as $page) 
                            <tr class="{{$page->page_status == '0' ? 'tr_disable':'tr_enable'}}">
                              <td scope="row">{{$count++}}</td>
                              <td>{{$page->page_name}}</td> 
                              <td>{{$page->page_language}}</td> 
                              <!-- <td>{{$page->is_category == '1'? 'Yes':'No'}}</td>  -->
                               <td>
                              <div class="form-check form-switch">
                            <input data-id="{{$page->id}}"  class="form-check-input m_c_status_checkbox" type="checkbox" role="switch" id="m_c_status_checkbox" {{$page->page_status == '1' ? 'checked':''}}>
                           </div>
                            </td>
                              <td class="d-flex justify-content-center">
                                <a value="{{$page->id}}" href="{{route('admin.pages.edit', [$page->id])}}" class="edit_button btn btn-primary m-r-10"><i class="fa fa-edit"></i></a>
                                <!-- <button value="{{$page->id}}" class="delete_button btn btn-primary"><i class="fa fa-trash-o"></i></button> -->
                             
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
                  {{$page_list->links('pagination::bootstrap-5')}}<br>
               </div>
                <div>
                  
               </div>
              </div> 
               
            </div>

            @if($page_list->count() == 0)
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
@if(Session::has('success'))
<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Success",
            text: "{{(Session::get('success'))}}"  ,
            icon: "success",
            button: "Ok"
        });
    });
</script>
@elseif(Session::has('failed'))
<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Failed",
            text: "{{(Session::get('failed'))}}",
            icon: "error",
            button: "Ok"
        });
    });
</script>
@endif 
@endsection
@endsection