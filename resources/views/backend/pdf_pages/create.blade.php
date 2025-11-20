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
                  <h3>Add PDF Page</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Add PDF Page</li>
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
                    <form class="row" action="{{route('admin.pdf_page.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                    <div class="col-sm-6">
                    <div class="form-group">
                          <label for="validationCustom01">Page Name (en):</label>
                          <input class="form-control" type="text" placeholder="Enter Page Name" name="page_name_en" value="{{old('page_name_en') }}">
                          @error('page_name_en')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="meta_title_en">Meta Title (en):</label>
                          <input class="form-control" type="text" placeholder="Enter Meta Title" name="meta_title_en"
                            value="{{old('meta_title') }}">
                        </div>

                        <div class="form-group">
                          <label for="meta_description_en">Meta Description (en):</label>
                          <textarea class="form-control" row="5" col="5" name="meta_description_en" id="meta_description_en"
                            placeholder="Enter Meta Description">{{old('meta_description')}}</textarea>
                        </div>

                        <div class="form-group">
                          <label for="validationCustom01">Page Name (hi):</label>
                          <input class="form-control" type="text" placeholder="Enter Page Name" name="page_name_hi" value="{{old('page_name_hi') }}">
                          @error('page_name_hi')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror
                        </div> 

                        <div class="form-group">
                          <label for="meta_title_hi">Meta Title (hi):</label>
                          <input class="form-control" type="text" placeholder="Enter Meta Title" name="meta_title_hi" value="{{old('meta_title') }}">
                        </div>

                        <div class="form-group">
                          <label for="meta_description_hi">Meta Description (hi):</label>
                          <textarea class="form-control" row="5" col="5" name="meta_description_hi" id="meta_description_hi" placeholder="Enter Meta Description">{{old('meta_description')}}</textarea>
                        </div>

                        <div class="form-group">
                          <label for="validationCustom01">Meta Keyword:</label>
                          <div id="meta_keywords_container">
                            <input type="text" id="meta_keyword_input" placeholder="Add Meta keywords" name="newKeyword">
                            <input type="hidden" id="meta_keywords_value" name="meta_keywords" class="form-control border-error-key_word" value="{{old('meta_keywords')}}">
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="short_description">Short Description:</label>
                          <textarea class="form-control" row="5" col="5" name="short_description" id="short_description" placeholder="Enter Short Description">{{old('short_description')}}</textarea>
                          @error('short_description')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="validationCustom01">Slug:</label>
                          <input class="form-control" id="slug" type="text" placeholder="Enter Slug" name="slug" value="{{old('slug')}}">
                          @error('slug')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror
                        </div>
                    </div>
                      <div class="col-sm-6"> 
                        <div class="form-group">
                      <div class="dropzone digits" id="upload_thumbnail">
                        <input type="file" name="thumbnail" id="thumbnail" class="thumbnail" style="display:none;">
                      <div class="m-0 dz-message needsclick"><i class="icon-cloud-up"></i>
                        <h6 class="mb-0">Click to upload thumbnail.</h6>
                      </div>
                    </div>
                    @error('thumbnail')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                    @enderror
                    <div class="thumbnail_preview">
                    <img id="thumbnailPreview" src="" alt="Image Preview" style="display: none;" width="100%">
                    </div>
                    <a id="removeThumbnail" href="javascript:void(0)" class="btn btn-secondary" style="display:none"><i class="fa fa-trash-o"></i></a>
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
$(document).ready(function() {

// Upload, preview and remove thumbnail all function (start)
  document.getElementById("upload_thumbnail").addEventListener("click", function() { 
      var thumbnailInput = document.getElementById("thumbnail"); 
        if (thumbnailInput) {
          thumbnailInput.click();
        }
  });

  $("#thumbnail").change(function (){
  var selectedFile = this.files[0];
    if(selectedFile){ 
      var reader = new FileReader();
      reader.onload = function(e){
        $("#thumbnailPreview").attr('src', e.target.result);
        $("#thumbnailPreview").show();
      };
      reader.readAsDataURL(selectedFile);
      $("#upload_thumbnail").hide();
      $("#removeThumbnail").show();
    }
  });

  $("#removeThumbnail").click(function(){
    $("#thumbnailPreview").attr('src', '');
    $("#thumbnailPreview").hide();
    $("#removeThumbnail").hide();
    $("#upload_thumbnail").show();
  }); 
// Upload, preview and remove thumbnail all function (ends)


// Meta Keyword (start) 
const metaKeywordContainer = document.getElementById("meta_keywords_container");
const metaKeywordInput = document.getElementById("meta_keyword_input");
const metaKeywords = []; // Array to store metaKeyword values
let = meta_keywords_value = document.getElementById('meta_keywords_value');

// Event listener for the input field
metaKeywordInput.addEventListener("keyup", function(event) { 
  if (event.key === "Enter" || event.key === ",") {
    event.preventDefault(); // Prevent Enter key from submitting a form
    const metaKeywordText = metaKeywordInput.value.replace(/[, ]+/g, " ").trim();
    if(metaKeywordText && !metaKeywords.includes(metaKeywordText)) {
        createMetaKeyword(metaKeywordText);
        metaKeywordInput.value = "";
   }else{
      metaKeywordInput.value = "";
   }                
  }
});

// Event listener for paste (auto-create metaKeywords)
metaKeywordInput.addEventListener("paste", function(event) {
    setTimeout(function() {
      const pastedText = metaKeywordInput.value;
      const metaKeywordTexts = pastedText.split(/[, ]+/).filter(text => text.trim() !== "");
      metaKeywordTexts.forEach(metaKeywordText => {
        if (metaKeywordText && !metaKeywords.includes(metaKeywordText)) {
            createMetaKeyword(metaKeywordText);
          }
      });
      metaKeywordInput.value = "";
    }, 0); // Delay to allow the input value to update after paste
});

// Function to create a new metaKeyword
function createMetaKeyword(text) {
  const metaKeyword = document.createElement("div");
  metaKeyword.classList.add("metaKeyword");
  metaKeyword.innerHTML = text;
  // Create close icon for the metaKeyword
  const closeIcon = document.createElement("span");
  closeIcon.classList.add("metaKeywordCloseIcon");
  closeIcon.innerHTML = "x";
  // Event listener for removing metaKeywords
  closeIcon.addEventListener("click", function() {
    metaKeyword.remove();
    // Remove the metaKeyword value from the array
     const index = metaKeywords.indexOf(text);
    if (index > -1) {
        metaKeywords.splice(index, 1);
    }
    meta_keywords_value.value = metaKeywords.join(',');
  });

  metaKeyword.appendChild(closeIcon);
  // metaKeywordContainer.appendChild(metaKeyword); 
  metaKeywordContainer.insertBefore(metaKeyword, metaKeywordInput);
   // Add the metaKeyword value to the array
  metaKeywords.push(text);
  meta_keywords_value.value = metaKeywords.join(','); // Update the hidden keyword_input with the current keywords (new)
}

    
  

 
});


</script>
@endsection