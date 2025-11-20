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
                  <h3>Create Other Page</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Other Page</li>
                    <li class="breadcrumb-item active">Create Page</li>
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
                    <h5>Edit Page</h5>
                  </div>
                  <div class="card-body add-post">
                    <form class="row" action="{{route('admin.other_pages.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf 
                    <div class="col-sm-6">
                    <div class="form-group">
                          <label for="validationCustom01">Page Name:</label>
                          <input class="form-control" id="page_name" type="text" placeholder="Enter page name" name="page_name" value="{{old('page_name')}}">
                          @error('page_name')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror
                        </div>
                    <div class="form-group">
                          <label for="validationCustom01">Meta Title:</label>
                          <input class="form-control" type="text" placeholder="Enter Meta Title" name="meta_title" value="{{old('meta_title')}}">
                          @error('meta_title')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="validationCustom01">Meta Description:</label>
                          <textarea class="form-control" row="5" col="5" name="meta_description" id="meta_description" placeholder="Enter Meta Description">{{old('meta_description')}}</textarea>
                          @error('meta_description')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="validationCustom01">Meta Keyword:</label>
                          <div id="meta_keywords_container">
                            <input type="text" id="meta_keyword_input" placeholder="Add Meta keywords" name="newKeyword">
                            <input type="hidden" id="meta_keywords_value" name="meta_keywords" class="form-control border-error-key_word" value="">
                            </div>
                        </div>
                        
                        

                        <div class="form-group">
                          <label for="short_description">Short Description:</label>
                          <textarea class="form-control" row="5" col="5" name="short_description" id="short_description" placeholder="Enter Short Description">{{old('short_description')}}</textarea>
                          @error('short_description')
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
                      <div class="form-group">
                          <label class="d-block">Select Language</label>
                          <select class="js-example-placeholder-multiple col-sm-12" name="page_language">
                            <option value="" >--Select Language--</option>
                            <option value="hi" {{old('page_language')=='hi'?'selected':''}}>Hindi</option>
                            <option value="en" {{old('page_language')=='en'?'selected':''}}>English</option>
                          </select>
                          @error('page_language')
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

                       

                      <div id="container">
                        <textarea id="editor" name="page_content">{{old('page_content')}}</textarea>
                        @error('page_content')
                            <p style="color:red; font-weight:bold;">{{$message}}</p> 
                             @enderror
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
// const metaKeywords = []; // Array to store metaKeyword values
const old_metaKeywords =  document.getElementById('meta_keywords_value').value;
const metaKeywords = old_metaKeywords.split(',');
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

<script>
        
           CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            ckfinder: {
          uploadUrl: '{{$user_type == 1 ? route("admin.ckeditor.upload", ["_token" => csrf_token()]) : route("writer.ckeditor.upload", ["_token" => csrf_token()]) }}',
          
        },
             toolbar: {
                   items: [
                       'exportPDF','exportWord', '|',
                       'findAndReplace', 'selectAll', '|',
                       'heading', '|',
                       'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                       'bulletedList', 'numberedList', 'todoList', '|',
                       'outdent', 'indent', '|',
                       'undo', 'redo',
                       '-',
                       'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                       'alignment', '|',
                       'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                       'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                       'textPartLanguage', '|',
                       'sourceEditing'
                   ],
                   shouldNotGroupWhenFull: true
               },
               
               list: {
                   properties: {
                       styles: true,
                       startIndex: true,
                       reversed: true
                   }
               },
              
               heading: {
                   options: [
                       { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                       { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                       { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                       { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                       { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                       { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                       { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                   ]
               },
             
               placeholder: 'Welcome to CKEditor 5!',
             
               fontFamily: {
                   options: [
                       'default',
                       'Arial, Helvetica, sans-serif',
                       'Courier New, Courier, monospace',
                       'Georgia, serif',
                       'Lucida Sans Unicode, Lucida Grande, sans-serif',
                       'Tahoma, Geneva, sans-serif',
                       'Times New Roman, Times, serif',
                       'Trebuchet MS, Helvetica, sans-serif',
                       'Verdana, Geneva, sans-serif'
                   ],
                   supportAllValues: true
               },
               // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
               fontSize: {
                   options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                   supportAllValues: true
               },
               // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
               // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
               htmlSupport: {
                   allow: [
                       {
                           name: /.*/,
                           attributes: true,
                           classes: true,
                           styles: true
                       }
                   ]
               },
               // Be careful with enabling previews
               // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
               htmlEmbed: {
                   showPreviews: true
               },
               // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
               link: {
                   decorators: {
                       addTargetToExternalLinks: true,
                       defaultProtocol: 'https://',
                       toggleDownloadable: {
                           mode: 'manual',
                           label: 'Downloadable',
                           attributes: {
                               download: 'file'
                           }
                       }
                   }
               },
               // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
               mention: {
                   feeds: [
                       {
                           marker: '@',
                           feed: [
                               '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                               '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                               '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                               '@sugar', '@sweet', '@topping', '@wafer'
                           ],
                           minimumCharacters: 1
                       }
                   ]
               },
               // The "super-build" contains more premium features that require additional configuration, disable them below.
               // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
               removePlugins: [
                   // These two are commercial, but you can try them out without registering to a trial.
                   // 'ExportPdf',
                   // 'ExportWord',
                   'CKBox',
                   'CKFinder',
                  //  'EasyImage',
                   // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                   // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                   // Storing images as Base64 is usually a very bad idea.
                   // Replace it on production website with other solutions:
                   // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                   'Base64UploadAdapter',
                   'RealTimeCollaborativeComments',
                   'RealTimeCollaborativeTrackChanges',
                   'RealTimeCollaborativeRevisionHistory',
                   'PresenceList',
                   'Comments',
                   'TrackChanges',
                   'TrackChangesData',
                   'RevisionHistory',
                   'Pagination',
                   'WProofreader',
                   // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                   // from a local file system (file://) - load this site via HTTP server if you enable MathType
                   'MathType'
               ]
           });
       </script>
@endsection