@extends('layouts/backend/main')
@section('main-section')


<style>
  #q-a-dropdown span {
    width: 70px !important;
  }

  #q-a-dropdown .select2-container--default .select2-selection--single .select2-selection__arrow {
    right: -14px !important;
  }

  #qa-category span {
    width: 120px !important;
  }

  #qa-category .select2-container--default .select2-selection--single .select2-selection__arrow {
    right: -43px !important;
  }
</style>
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Question & Answer</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Question & Answer</li>
          </ol>
        </div>

        @if(Auth::user()->user_type == 1)
        <div class="col-sm-6 d-flex justify-content-end">
          <!-- Button trigger modal --> 
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewModal">
            Add New Question
          </button> 
        </div>
        @endif
        
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
                <div class="col-md-12">
                  <div class="card-body d-flex" style="justify-content: space-between;">
                    <div class="qa-row d-flex">
                      <label class="col-form-label">Row:</label>
                      <div id="q-a-dropdown">
                        <select class="js-example-basic-single col-sm-4" name="qty" id="qty">
                          <option value="10" {{isset($_GET['qty']) && $_GET['qty']=='10' ? 'selected' : '' }}>10
                          </option>
                          <option value="20" {{isset($_GET['qty']) && $_GET['qty']=='20' ? 'selected' : '' }}>20
                          </option>
                          <option value="50" {{isset($_GET['qty']) && $_GET['qty']=='50' ? 'selected' : '' }}>50
                          </option>
                          <option value="100" {{isset($_GET['qty']) && $_GET['qty']=='100' ? 'selected' : '' }}>100
                          </option>
                          <option value="250" {{isset($_GET['qty']) && $_GET['qty']=='250' ? 'selected' : '' }}>250
                          </option>
                          <option value="500" {{isset($_GET['qty']) && $_GET['qty']=='500' ? 'selected' : '' }}>500
                          </option>
                        </select>
                      </div> 
                    </div> 

                    <div class="card-bod">
                      <form class="theme-form d-flex" method="GET" action="{{URL::full()}}" style=" justify-content: space-between;">
                        <div class="d-flex mx-2" id="qa-category">
                          <label class="col-form-label">Sort By:</label>
                          <select class="js-example-basic-single col-sm-4 select_filter" name="select_filter">
                            <option value="default" {{isset($_GET['select_filter']) && $_GET['select_filter']=='default' ? 'selected' :''}}>
                              Default</option>
                            <option value="date_desc" {{isset($_GET['select_filter']) && $_GET['select_filter']=='date_desc' ? 'selected'
                              :''}}>Latest Question & Answer</option>
                            <option value="date_asc" {{isset($_GET['select_filter']) && $_GET['select_filter']=='date_asc' ? 'selected'
                              :''}}>
                              Old Question & Answer</option>
                          </select>
                        </div>
                    
                        <div class=" mx-3  d-flex" id="qa-category">
                          <label class="col-form-label">Category:</label>
                          <select class="js-example-basic-single col-sm-4 select_filter" name="main_cat_filter">
                            <option value="">All Category</option>
                            @foreach($main_cat_list as $m_cat)
                            <option value="{{$m_cat->id}}" {{isset($_GET['main_cat_filter']) && $_GET['main_cat_filter']==$m_cat->id
                              ? 'selected' :''}}>{{$m_cat->main_category_name_en}}</option>
                            @endforeach
                    
                          </select>
                          <button type="submit" class="btn btn-primary">Apply Filter</button>
                        </div>
                      </form>
                    </div>
                    
                    <form class="theme-form" method="GET" action="{{URL::full()}}">
                      <div class="form-group d-flex justify-content-end">
                        <input class="form-control" name="search" type="text" placeholder="Search by question..."
                          value="{{isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : ''}}">
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                    </form>

                    
                  </div>



                </div>
                <!-- <div class="col-md-6 ">
                  

                </div> -->
              </div>


              <div class="table-responsive">
                @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count =
                $page_number * 10 - 9; @endphp
                <table class="table">
                  <thead class="bg-primary">
                    <tr>
                      <th scope="col">S.NO</th>
                      <th scope="col">Question</th>
                      <th scope="col">Category</th>
                      <th scope="col">User Name</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- question and answer for admin with all question and answer list (start) -->
                    @if(Auth::user()->user_type == 1)
                    @foreach($que_list as $question)
                    <tr style="background:#dde2ee"
                      class="{{$question->question_status == '0' ? 'tr_disable':'tr_enable'}}">
                      <th scope="row">Q. {{$count++}}.</th>
                      <td>{{$question->question_en}}</td>
                      <td>{{$question->mainCategory->main_category_name_en}}</td>
                      <td>{{$question->user->name}}
                        @if($question->user->user_type == 1) (Admin)
                        @elseif($question->user->user_type == 2)(Writer)
                        @elseif($question->user->user_type == 3)User
                        @endif</td>

                      @if(Auth::user()->user_type == 1)
                      <td>
                        <div class="form-check form-switch">
                          <input data-id="{{$question->id}}" class="form-check-input q_status_checkbox" type="checkbox"
                            role="switch" id="q_status_checkbox" {{$question->question_status == '1' ?
                          'checked':''}}>
                        </div>
                      </td>
                      @else
                      <td>
                        @if($question->question_status == 0) Not Approve
                        @elseif($question->question_status == 1) Approve
                        @elseif($question->question_status == 2) ending @endif
                      </td>
                      @endif
                      @if(Auth::user()->user_type == 1)
                      <td class="d-flex">
                        <button value="{{$question->id}}" class="edit_button btn btn-primary m-r-10" id="edit_button"><i
                            class="fa fa-edit"></i></button>
                        <button value="{{$question->id}}" class="delete_button btn btn-primary mx-2"
                          id="delete_button"><i class="fa fa-trash-o"></i></button>
                      </td>
                      @endif
                    </tr>

                    @foreach($question->answers_for_admin as $answer)
                    <tr class="{{$answer->answer_approval_status == '0' ? 'tr_disable':'tr_enable'}}">
                      <td>Ans:-</td>
                      <td>{{$answer->answer}} </td>
                      <td>
                      </td>
                      <td>{{$answer->user->name}}
                        @if($answer->user->user_type == 1) (Admin)
                        @elseif($answer->user->user_type == 2) (Writer)
                        @elseif($answer->user->user_type == 3) User @endif</td>

                      <td>
                        <div class="form-check form-switch">
                          <input data-id="{{$answer->id}}" class="form-check-input a_status_checkbox" type="checkbox"
                            role="switch" id="a_status_checkbox" {{$answer->answer_approval_status == '1' ?
                          'checked':''}}>
                        </div>
                      </td>

                      <td>
                      </td>
                    </tr>
                    @endforeach
                    @endforeach
                    <!-- question and answer for admin with all question and answer list (end) -->


                    @else
                    <!-- question and answer for user and writer with all his question and answer list (start) -->
                    @foreach($que_list as $question)

                    @if($question->question_status == 1)

                    @if (count($question->answers_for_user) !== 0)
                    <tr class="{{$question->question_status == '0' ? 'tr_disable':'tr_enable'}}">
                      <th scope="row">Q. {{$count++}}.</th>
                      <td>{{$question->question}}</td>
                      <td>{{$question->user->name}}
                        @if($question->user->user_type == 1) (Admin)
                        @elseif($question->user->user_type == 2) (Writer)
                        @elseif($question->user->user_type == 3) (User)
                        @endif</td>
                      <td></td>
                      @if(Auth::user()->user_type == 1)
                      <td>
                        <div class="form-check form-switch">
                          <input data-id="{{$question->id}}" class="form-check-input q_status_checkbox" type="checkbox"
                            role="switch" id="q_status_checkbox" {{$question->question_status == '1' ?
                          'checked':''}}>
                        </div>
                      </td>
                      @else
                      <td></td>
                      @endif
                    </tr>

                    @foreach($question->answers_for_user as $answer)
                    <tr class="{{$answer->answer_approval_status == '0' ? 'tr_disable':'tr_enable'}}">
                      <td>Ans:-</td>
                      <td>{{$answer->answer}} </td>
                      <td>{{$answer->user->name}}
                        @if($answer->user->user_type == 1) (Admin)
                        @elseif($answer->user->user_type == 2) (Writer)
                        @elseif($answer->user->user_type == 3) User @endif</td>
                      <td></td>
                      <td>
                        @if($answer->answer_approval_status == 0) Not Approve
                        @elseif($answer->answer_approval_status == 1) Approve
                        @elseif($answer->answer_approval_status == 2) Pending @endif


                      </td>
                      <td>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                    @endif
                    @endforeach
                    @endif

                    <!-- question and answer for user and writer with all his question and answer list (end) -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div>
          {{$que_list->links('pagination::bootstrap-5')}}<br>
        </div>
      </div>

      @if($que_list->count() == 0)
      <div class="pt-4">
        <h5 class="text-center">No Data Available</h5>
      </div>
      @endif
    </div>
  </div>
  <!-- tap on top starts-->
  <div class="tap-top"><i class="icon-control-eject"></i></div>
  <!-- tap on tap ends-->
  <!-- Modal -->
  <div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('admin.question_and_answer.store')}}">
            @csrf
            <div class="col-md-12">
              <label class="form-label" for="question_hi">Question (hi)</label>
              <textarea class="form-control" id="question_hi" name="question_hi" placeholder="Enter your question (hi)"
                required="" col="5" row="5"></textarea>
            </div>

            <div class="col-md-12">
              <label class="form-label" for="question_en">Question (en)</label>
              <textarea class="form-control" id="question_en" name="question_en" placeholder="Enter your question (en)"
                required="" col="5" row="5"></textarea>
            </div>


            <div class="col-md-12 mt-3">
              <label class="form-label" for="question_category">Select Category</label>
              <select class="form-control" id="question_category" name="question_category">
                <option selected value="1">--Select Category--</option>
                @foreach($main_cat_list as $main_cat)
                <option value="{{$main_cat->id}}">{{$main_cat->main_category_name_en}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12 mt-3">
              <label class="form-label" for="question_status">Select Status</label>
              <select class="form-control" id="question_status" name="question_status">
                <option selected value="1">Active</option>
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

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.question_and_answer.update')}}" method="POST">
            @csrf
            <input type="hidden" name="edit_q_id" id="edit_q_id">
            <div class="col-md-12">
              <label class="form-label" for="edit_question_hi">Edit Question (hi)</label>
              <textarea class="form-control" id="edit_question_hi" name="edit_question_hi"
                placeholder="Enter your question (hi)" required="" col="5" row="5"></textarea>
            </div>

            <div class="col-md-12">
              <label class="form-label" for="edit_question_en">Edit Question (en)</label>
              <textarea class="form-control" id="edit_question_en" name="edit_question_en"
                placeholder="Enter your question (en)" required="" col="5" row="5"></textarea>
            </div>

            <div class="col-md-12 mt-3">
              <label class="form-label" for="edit_question_category">Select Category</label>
              <select class="form-control" id="edit_question_category" name="edit_question_category">
                @foreach($main_cat_list as $main_cat)
                <option value="{{$main_cat->id}}">{{$main_cat->main_category_name_en}}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label" for="edit_question_status">Select Status</label>
              <select class="form-select" id="edit_question_status" name="edit_question_status">
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
</div>
@endsection

@section('javascript-section')
@if(Session::has('que_posted_success'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('que_posted_success'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('que_posted_failed'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Failed",
      text: "{{(Session::get('que_posted_failed'))}}",
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
@endif

<script>
  // Edit modal setu value
  $(document).ready(function ()
  {
    $(document).on('click', '.edit_button', function ()
    {
      var q_id = $(this).val();
      $('#editModal').modal('show');
      $.ajax({
        type: "GET",
        url: "question-and-answer/edit/" + q_id,
        success: function (response)
        {
          $('#edit_q_id').val(response.q_detail.id)
          $('#edit_question_en').val(response.q_detail.question_en);
          $('#edit_question_hi').val(response.q_detail.question_hi);
          $('#edit_question_category').val(response.q_detail.main_category_id);
          $("#edit_question_status").val(response.q_detail.question_status);
        }
      });
    });

    // delete category reques
    $(document).on('click', '.delete_button', function ()
    {
      var q_id = $(this).val();
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
            url: "question-and-answer/delete/" + q_id,
            method: "GET",
            success: function ()
            {
              swal({
                title: "Success",
                text: "Question has been deleted !",
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
          swal("Cancelled", "You dont delete any category !", "error");
        }
      })


    });


    $(document).on('change', '.q_status_checkbox', function ()
    {
      var $toggleButton = $(this);
      var q_status = $toggleButton.prop('checked') ? 1 : 0;
      var q_id = $(this).data('id');

      $.ajax({
        type: "GET",
        url: "{{route('admin.question_and_answer.update_status')}}",
        data: { 'q_status': q_status, 'q_id': q_id },
        success: function (data)
        {
          if (data.status == 200 && data.message == 'status_updated')
          {
            swal('Status Changed Successfully');
            // Change the row color based on the button's status
            var row = $toggleButton.closest('tr');
            if (q_status == 1)
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


    $(document).on('change', '.a_status_checkbox', function ()
    {

      var $toggleButton = $(this);
      var a_status = $toggleButton.prop('checked') ? 1 : 0;
      var a_id = $(this).data('id');

      $.ajax({
        type: "GET",
        url: "{{route('admin.question_and_answer.update_a_status')}}",
        data: { 'a_status': a_status, 'a_id': a_id },
        success: function (data)
        {
          if (data.status == 200 && data.message == 'status_updated')
          {
            swal('Status Changed Successfully');
            // Change the row color based on the button's status
            var row = $toggleButton.closest('tr');
            if (a_status == 1)
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




  });


</script>

@if(Auth::user()->user_type == 1)
<script>
  $(document).ready(function ()
  {
    //  Select Row
    $(document).on('change', '#qty', function ()
    {
      const qty = $(this).val();
      var current_url = "{{route('admin.question_and_answer.index')}}";
      window.location.replace(current_url + '?qty=' + qty);
    });
  });
</script>
@elseif(Auth::user()->user_type == 2)
<script>
  $(document).ready(function ()
  {
    //  Select Row
    $(document).on('change', '#qty', function ()
    {
      const qty = $(this).val();
      var current_url = "{{route('writer.question_and_answer.index')}}";
      window.location.replace(current_url + '?qty=' + qty);
    });
  });
</script>
@elseif(Auth::user()->user_type == 3)
<script>
  $(document).ready(function ()
  {
    //  Select Row
    $(document).on('change', '#qty', function ()
    {
      const qty = $(this).val();
      var current_url = "{{route('user.question_and_answer.index')}}";
      window.location.replace(current_url + '?qty=' + qty);
    });
  });
</script>
@endif

@endsection