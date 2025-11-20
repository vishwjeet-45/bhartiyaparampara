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
          <h3>Edit PDF Upload</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item active">Edit PDF Upload</li>
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
            <form class="row" action="{{route('admin.upload_pdf.update', [$pdf_file->id])}}" method="POST"
              enctype="multipart/form-data">
              @csrf
              <input type="hidden" value="{{$pdf_file->year}}" name="year">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="validationCustom01">File Title (hi):</label>
                  <input class="form-control" type="text" placeholder="Enter File Title" name="file_title_hi"
                    value="{{$pdf_file->pdf_file_title_hi}}">
                  @error('file_title_hi')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>
                
                 <div class="form-group">
                  <label for="validationCustom01">File Title (en):</label>
                  <input class="form-control" type="text" placeholder="Enter File Title" name="file_title_en"
                    value="{{$pdf_file->pdf_file_title_en}}">
                  @error('file_title_en')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>

               
                  <label>Short Description (hi):</label>
                  <textarea id="textArea" name="short_description_hi"  placeholder="Enter Short Description">{{$pdf_file->short_description_hi}}</textarea>
                  @error('short_description_hi')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                    <br>
                <label>Short Description (en):</label>
                  <textarea id="textArea2" name="short_description_en"  placeholder="Enter Short Description">{{$pdf_file->short_description_en}}</textarea>
                  @error('short_description_en')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror

                  
                 

                  <!--<div class="col-md-12">-->
                  <!--  <label class="form-label" for="language">Select Language</label>-->
                  <!--  <select class="form-select" id="language" name="language" required>-->
                  <!--    <option>--Select--</option>-->
                  <!--    <option value="hi" {{$pdf_file->file_language == 'hi'?'selected':''}}>Hindi</option>-->
                  <!--    <option value="en" {{$pdf_file->file_language == 'en'?'selected':''}}>English</option>-->
                  <!--  </select>-->
                  <!--  @error('language')-->
                  <!--  <p style="color:red; font-weight:bold;">{{$message}}</p>-->
                  <!--  @enderror-->
                  <!--</div>-->

                 
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
                    <img id="thumbnailPreview"
                      src="{{url('public/build/assets/upload/thumbnail/pdf_file_thumbnail')}}/{{$pdf_file->thumbnail}}"
                      alt="Image Preview" width="100%">
                  </div>
                  <a id="removeThumbnail" href="javascript:void(0)" class="btn btn-secondary" style="display:none"><i
                      class="fa fa-trash-o"></i></a>
                </div>

                <div class="form-group">
                  <label for="pdf_file">Upload PDF:</label>
                  <input type="file" class="form-control" name="pdf_file" id="pdf_file">
                  @error('pdf_file')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>

                <div class="form-group">
                          <label for="pdf_file">Date:</label>
                          <input type="date" class="form-control" name="date" id="date" value="{{Carbon\Carbon::parse($pdf_file->created_at)->format('Y-m-d')}}">
                          @error('date')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror
                        </div>
                         <div class="col-md-12">
                    <label class="form-label" for="main_page">Select Main Page</label>
                    <select class="form-select" id="main_page" name="main_page" required>
                      <option>--Select--</option>
                      @foreach($pdf_page_list as $pdf_page)
                      <option value="{{$pdf_page->id}}" {{$pdf_page->id == $pdf_file->pdf_page_id ?
                        'selected':''}}>{{$pdf_page->page_name_en}}</option>
                      @endforeach
                    </select>
                  </div>
                   <div class="form-group">
                  <label for="downloads">No of Downloads:</label>
                  <input class="form-control" type="number" placeholder="Enter File Title" name="downloads"
                    value="{{$pdf_file->downloads}}">
                  @error('downloads')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
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
  $(document).ready(function ()
  {

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
    });
    // Upload, preview and remove thumbnail all function (ends)


    // Meta Keyword (start) 
    const metaKeywordContainer = document.getElementById("meta_keywords_container");
    const metaKeywordInput = document.getElementById("meta_keyword_input");
    const metaKeywords = []; // Array to store metaKeyword values
    let = meta_keywords_value = document.getElementById('meta_keywords_value');

    // Event listener for the input field
    metaKeywordInput.addEventListener("keyup", function (event)
    {
      if (event.key === "Enter" || event.key === ",")
      {
        event.preventDefault(); // Prevent Enter key from submitting a form
        const metaKeywordText = metaKeywordInput.value.replace(/[, ]+/g, " ").trim();
        if (metaKeywordText && !metaKeywords.includes(metaKeywordText))
        {
          createMetaKeyword(metaKeywordText);
          metaKeywordInput.value = "";
        } else
        {
          metaKeywordInput.value = "";
        }
      }
    });

    // Event listener for paste (auto-create metaKeywords)
    metaKeywordInput.addEventListener("paste", function (event)
    {
      setTimeout(function ()
      {
        const pastedText = metaKeywordInput.value;
        const metaKeywordTexts = pastedText.split(/[, ]+/).filter(text => text.trim() !== "");
        metaKeywordTexts.forEach(metaKeywordText =>
        {
          if (metaKeywordText && !metaKeywords.includes(metaKeywordText))
          {
            createMetaKeyword(metaKeywordText);
          }
        });
        metaKeywordInput.value = "";
      }, 0); // Delay to allow the input value to update after paste
    });

    // Function to create a new metaKeyword
    function createMetaKeyword(text)
    {
      const metaKeyword = document.createElement("div");
      metaKeyword.classList.add("metaKeyword");
      metaKeyword.innerHTML = text;
      // Create close icon for the metaKeyword
      const closeIcon = document.createElement("span");
      closeIcon.classList.add("metaKeywordCloseIcon");
      closeIcon.innerHTML = "x";
      // Event listener for removing metaKeywords
      closeIcon.addEventListener("click", function ()
      {
        metaKeyword.remove();
        // Remove the metaKeyword value from the array
        const index = metaKeywords.indexOf(text);
        if (index > -1)
        {
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


<script>
  $(document).ready(function ()
  {

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
    });
    // Upload, preview and remove thumbnail all function (ends)


    // Meta Keyword (start) 
    const metaKeywordContainer = document.getElementById("meta_keywords_container");
    const metaKeywordInput = document.getElementById("meta_keyword_input");
    const metaKeywords = []; // Array to store metaKeyword values
    let = meta_keywords_value = document.getElementById('meta_keywords_value');

    // Event listener for the input field
    metaKeywordInput.addEventListener("keyup", function (event)
    {
      if (event.key === "Enter" || event.key === ",")
      {
        event.preventDefault(); // Prevent Enter key from submitting a form
        const metaKeywordText = metaKeywordInput.value.replace(/[, ]+/g, " ").trim();
        if (metaKeywordText && !metaKeywords.includes(metaKeywordText))
        {
          createMetaKeyword(metaKeywordText);
          metaKeywordInput.value = "";
        } else
        {
          metaKeywordInput.value = "";
        }
      }
    });

    // Event listener for paste (auto-create metaKeywords)
    metaKeywordInput.addEventListener("paste", function (event)
    {
      setTimeout(function ()
      {
        const pastedText = metaKeywordInput.value;
        const metaKeywordTexts = pastedText.split(/[, ]+/).filter(text => text.trim() !== "");
        metaKeywordTexts.forEach(metaKeywordText =>
        {
          if (metaKeywordText && !metaKeywords.includes(metaKeywordText))
          {
            createMetaKeyword(metaKeywordText);
          }
        });
        metaKeywordInput.value = "";
      }, 0); // Delay to allow the input value to update after paste
    });

    // Function to create a new metaKeyword
    function createMetaKeyword(text)
    {
      const metaKeyword = document.createElement("div");
      metaKeyword.classList.add("metaKeyword");
      metaKeyword.innerHTML = text;
      // Create close icon for the metaKeyword
      const closeIcon = document.createElement("span");
      closeIcon.classList.add("metaKeywordCloseIcon");
      closeIcon.innerHTML = "x";
      // Event listener for removing metaKeywords
      closeIcon.addEventListener("click", function ()
      {
        metaKeyword.remove();
        // Remove the metaKeyword value from the array
        const index = metaKeywords.indexOf(text);
        if (index > -1)
        {
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
<script>
  tinymce.init({
    selector:
      '#textArea'
  });
</script>

<script>
  tinymce.init({
    selector:
      '#textArea2'
  });
</script>
@endsection