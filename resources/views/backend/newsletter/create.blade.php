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
          <h3>Create Newsletter</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Newsletter</li>
            <li class="breadcrumb-item active">Create Newsletter</li>
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
            <h5>Create Newsletter</h5>
          </div>
          <div class="card-body add-post">
            <form class="row" action="{{route('admin.newsletter.create')}}"
              method="POST" enctype="multipart/form-data">
              @csrf
              <!-- <div class="col-sm-6">
                <div class="form-group">
                  <label for="validationCustom01">Title:</label>
                  <input class="form-control" type="text" placeholder="Enter Title" name="title"
                    value="{{old('title') }}"> 
                </div> 
              </div>  
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="validationCustom01">Subject:</label>
                  <input class="form-control" type="text" placeholder="Enter  Subject" name="subject"
                    value="{{old('subject') }}"> 
                </div> 
              </div> -->
              <div class="col-sm-12">
              <div class="form-group">
                  <label for="validationCustom01">Message:</label>
                  <!-- <textarea class="form-control" row="5" col="5" name="message" id="message"
                    placeholder="Writer Your Message"></textarea> -->
                    <textarea class="form-control" id="message"  row="5" col="5" name="message"
                      placeholder="Enter Short Description">{{old('message')}}</textarea>
                    @error('message')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>
              </div> 

              <div class="col-md-6 mt-3">
              <label class="form-label" for="subject">Enter Subject</label>
              <input class="form-control" id="subject" type="text" name="subject" placeholder="subject" value="{{old('subject')}}"> 
              @error('subject')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
            </div>

              <div class="col-md-6 mt-3">
              <label class="form-label" for="attachment">Upload Attachment</label>
              <input class="form-control" id="attachment" type="file" name="attachment">
              @error('attachment')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
            </div>
 
              <div class="btn-showcase">
                <button class="btn btn-primary mt-2" type="submit">Send</button>
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
      '#message'
  });
</script>
@endsection