@extends('layouts/backend/main')
@section('main-section')
@php
$user_type = Auth::user()->user_type;
@endphp

<div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Upload PDF File</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Upload PDF File</li>
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
                  <div class="card-header pb-0">
                  </div>
                  <div class="card-body add-post">
                    <form class="row" action="{{route('admin.upload_pdf.store')}}" method="POST" enctype="multipart/form-data"
                    onsubmit="return validateForm()" id="upload_pdf_form">
                      @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="validationCustom01">File Title (hi):</label>
                          <input class="form-control" type="text" placeholder="Enter File Title (hi)" name="file_title_hi" id="file_title_hi" value="{{old('file_title_hi') }}">
                          <p style="color:red; font-weight:bold;" id="file_title_hi_error"></p>
                        <!-- @error('file_title')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror -->
                        </div>
                        
                          <div class="form-group">
                          <label for="validationCustom01">File Title (en):</label>
                          <input class="form-control" type="text" placeholder="Enter File Title (en)" name="file_title_en" id="file_title_en" value="{{old('file_title_en') }}">
                          <p style="color:red; font-weight:bold;" id="file_title_en_error"></p> 
                        <!-- @error('file_title')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror -->
                        </div>
 
                        <div class="form-group">
                          <label for="short_description">Short Description (hi):</label> 
                          <textarea id="short_description_hi" name="short_description_hi"
                            placeholder="Enter Short Description">{{old('short_description_hi')}}</textarea>
                            <p style="color:red; font-weight:bold;" id="short_description_hi_error"></p> 
                         
                            <!-- @error('short_description')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror -->
                        </div>
                        
                          <div class="form-group">
                          <label for="short_description">Short Description (en):</label> 
                          <textarea id="short_description_en" name="short_description_en"
                            placeholder="Enter Short Description">{{old('short_description_en')}}</textarea>
                            <p style="color:red; font-weight:bold;" id="short_description_en_error"></p> 
                         
                            <!-- @error('short_description')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror -->
                        </div>

                      
                         
                      <!-- <div class="col-md-12">-->
                      <!--  <label class="form-label" for="language">Select Language</label>-->
                      <!--  <select class="form-select" id="language" name="language">-->
                      <!--  <option value="">--Select--</option>  -->
                      <!--  <option value="hi">Hindi</option> -->
                      <!--  <option value="en">English</option>  -->
                      <!--  </select>-->
                      <!--  <p style="color:red; font-weight:bold;" id="language_error"></p>  -->
                      <!--@error('language')-->
                      <!--  <p style="color:red; font-weight:bold;">{{$message}}</p> -->
                      <!--  @enderror -->
                      <!-- </div>-->

                    </div>
                      <div class="col-sm-6"> 
                        <div class="form-group">
                      <div class="dropzone digits" id="upload_thumbnail">
                        <input type="file" name="thumbnail" id="thumbnail" class="thumbnail" style="display:none;">
                      <div class="m-0 dz-message needsclick"><i class="icon-cloud-up"></i>
                        <h6 class="mb-0">Click to upload thumbnail.</h6>
                      </div>
                    </div>
                    <p style="color:red; font-weight:bold;" id="thumbnail_error"></p> 
                    <!-- @error('thumbnail')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                    @enderror -->
                    <div class="thumbnail_preview">
                    <img id="thumbnailPreview" src="" alt="Image Preview" style="display: none;" width="100%">
                    </div>
                    <a id="removeThumbnail" href="javascript:void(0)" class="btn btn-secondary" style="display:none"><i class="fa fa-trash-o"></i></a>
                      </div>
                       
                      <div class="form-group">
                          <label for="pdf_file">Upload PDF:</label>
                          <input type="file" class="form-control" name="pdf_file" id="pdf_file">
                          <p style="color:red; font-weight:bold;" id="pdf_file_error"></p> 

                          <!-- @error('pdf_file')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror -->
                        </div>

                        <div class="form-group">
                          <label for="pdf_file">Date:</label>
                          <input type="date" class="form-control" name="date" id="date" value="">
                          <p style="color:red; font-weight:bold;" id="date_error"></p> 

                          <!-- @error('date')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror -->
                        </div>
                        
                          <div class="col-md-12">
                        <label class="form-label" for="main_page">Select Main Page</label>
                        <select class="form-select" id="main_page" name="main_page">
                        <option value="">--Select--</option> 
                        @foreach($pdf_page_list as $pdf_page)
                        <option value="{{$pdf_page->id}}">{{$pdf_page->page_name_en}}</option> 
                        @endforeach
                        </select>
                        <p style="color:red; font-weight:bold;" id="main_page_error"></p> 

                       </div>
                      
                      </div>

                       
                      <div class="btn-showcase">
                      <button class="btn btn-primary" type="submit">Post</button> 
                    </div>
                    </form>
                    
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div> 
@endsection

@section('javascript-section')
<script>
function validateForm() { 
      document.getElementById('file_title_hi_error').innerText = ''; 
       document.getElementById('file_title_en_error').innerText = ''; 
      document.getElementById('short_description_hi_error').innerText = '';
       document.getElementById('short_description_en_error').innerText = ''; 
      document.getElementById('main_page_error').innerText = ''; 
      document.getElementById('language_error').innerText = '';   
      document.getElementById('date_error').innerText = '';  
      document.getElementById('pdf_file_error').innerText = ''; // New line for PDF file error
      document.getElementById('thumbnail_error').innerText = ''; // New line for thumbnail error
      
 
      var file_title_hi = document.getElementById('file_title_hi').value; 
      var file_title_en = document.getElementById('file_title_en').value;  
      var short_description_hi = tinymce.get('short_description_hi').getContent();  
      var short_description_en = tinymce.get('short_description_en').getContent(); 
      var main_page = document.getElementById('main_page').value;  
      var language = document.getElementById('language').value;  
      var date = document.getElementById('date').value;   
      var pdf_file = document.getElementById('pdf_file').value; // File input element for PDF
      var thumbnail = document.getElementById('thumbnail').value; // File input element for thumbnail
      
      if (file_title_hi === '') {
        document.getElementById('file_title_hi_error').innerText = 'File Title is required';
        document.getElementById('file_title_hi').focus();
        scrollIntoView('file_title_hi');
        return false;  
      }else if (file_title_en === '') {
        document.getElementById('file_title_en_error').innerText = 'File Title is required';
        document.getElementById('file_title_en').focus();
        scrollIntoView('file_title_en');
        return false;  
      }else if (short_description_hi.trim() === '') {
        document.getElementById('short_description_hi_error').innerText = 'Short Description is required'; 
        tinymce.get('short_description_hi').focus();
        scrollIntoView('short_description_hi_error');
        return false;  
      }else if (short_description_en.trim() === '') {
        document.getElementById('short_description_en_error').innerText = 'Short Description is required'; 
        tinymce.get('short_description_en').focus();
        scrollIntoView('short_description_en_error');
        return false;  
      }else if (main_page === '') {
        document.getElementById('main_page_error').innerText = 'Please select main page';
        $('#main_page').focus();
        scrollIntoView('main_page');
        return false;  
      }else if (language === '') {
        document.getElementById('language_error').innerText = 'Please select language';
        $('#language').focus();
        scrollIntoView('language');
        return false;  
      }else if (date === '') {
        document.getElementById('date_error').innerText = 'Please select date';
        $('#date').focus();
        scrollIntoView('date');
        return false;  
      }else if (pdf_file === '') {
        document.getElementById('pdf_file_error').innerText = 'Please select a PDF file';
        $('#pdf_file').focus();
        scrollIntoView('pdf_file_error');
        return false;  
    }else if (thumbnail === '') {
        document.getElementById('thumbnail_error').innerText = 'Please select a PDF file';
        $('#thumbnail').focus();
        scrollIntoView('thumbnail_error');
        return false;  
    } 
      
      else{
        document.getElementById('upload_pdf_form').submit();
      }
    }

    function scrollIntoView(elementId) {
      var element = document.getElementById(elementId);
      if (element) {
        element.scrollIntoView({
          behavior: 'smooth',
          block: 'center',
          inline: 'center'
        });
      }
    }
  </script>

<script>
$(document).ready(function() {
  document.getElementById("date").max = new Date().toISOString().split('T')[0];

    // Upload, preview and remove thumbnail all function (start)
    document.getElementById("upload_thumbnail").addEventListener("click", function ()
    {
      var thumbnailInput = document.getElementById("thumbnail");
      if (thumbnailInput)
      {
        thumbnailInput.click();
      }
    });

    $("#thumbnail").change(function ()
    {
      var selectedFile = this.files[0];
      if (selectedFile)
      {
        var reader = new FileReader();
        reader.onload = function (e)
        {
          $("#thumbnailPreview").attr('src', e.target.result);
          $("#thumbnailPreview").show();
        };
        reader.readAsDataURL(selectedFile);
        $("#upload_thumbnail").hide();
        $("#removeThumbnail").show();
      }
    });

    $("#removeThumbnail").click(function ()
    {
      $("#thumbnailPreview").attr('src', '');
      $("#thumbnailPreview").hide();
      $("#removeThumbnail").hide();
      $("#upload_thumbnail").show();
      document.getElementById('thumbnail').value = "";
    });
    // Upload, preview and remove thumbnail all function (ends)

 
 
  });
 
</script>
<script>
  tinymce.init({
    selector:
      '#short_description_hi'
  });
</script>
<script>
  tinymce.init({
    selector:
      '#short_description_en'
  });
</script>
@endsection