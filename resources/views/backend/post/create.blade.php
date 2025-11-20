@extends('layouts/backend/main')
@section('main-section')
@php
$user_type = Auth::user()->user_type;
@endphp

<style>

.tox-notifications-container,.tox-statusbar{
  display:none !important;
}
.tox-menu .tox-collection .tox-collection--list .tox-selected-menu,.tox-collection__group {
      min-width: 230px !important;
}
</style>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Add Post</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Post</li>
            <li class="breadcrumb-item active">Add Post</li>
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
            <h5>Post Edit</h5>
          </div>
          <div class="card-body add-post">
            <form class="row" action="
              @if($user_type == 1)
              {{route('admin.post.store')}}
              @elseif($user_type == 2)
              {{route('writer.post.store')}}
              @elseif($user_type == 3)
              {{route('user.post.store')}}
              @endif "
              method="POST" id="create_post_form" enctype="multipart/form-data" onsubmit="return validateForm()">
              @csrf
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="validationCustom01">Meta Title:</label>
                  <input class="form-control" type="text" placeholder="Enter Meta Title" name="meta_title"
                    value="{{old('meta_title') }}" >

                </div>

                <div class="form-group">
                  <label for="validationCustom01">Meta Description:</label>
                  <textarea class="form-control" row="5" col="5" name="meta_description" id="meta_description"
                    placeholder="Enter Meta Description">{{old('meta_description')}}</textarea>
                </div>

                <div class="form-group">
                  <label for="validationCustom01">Meta Keyword:</label>
                  <div id="meta_keywords_container">
                    <input type="text" id="meta_keyword_input" placeholder="Add Meta keywords" name="newKeyword">
                    <input type="hidden" id="meta_keywords_value" name="meta_keywords"
                      class="form-control border-error-key_word" value="{{old('meta_keywords')}}">
                  </div>
                </div>


                <div class="form-group">
                  <label for="short_description">Short Description:</label>
                  <!-- <textarea class="form-control" row="5" col="5" name="short_description" id="short_description"
                    placeholder="Enter Short Description">{{old('short_description')}}</textarea> -->
                    <textarea id="short_description" name="short_description"
                      placeholder="Enter Short Description">{{old('short_description')}}</textarea>

                      <p style="color:red; font-weight:bold;" id="short_description_error"></p>
                  @error('short_description')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>


                <div class="form-group">
                  <label for="validationCustom01">Slug:</label>
                  <input class="form-control" id="slug" type="text" placeholder="Enter Slug" name="slug"
                    value="{{old('slug')}}">
                  <p style="color:red; font-weight:bold;" id="slug_error"></p>

                  @error('slug')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="d-block">Select Language</label>
                  <select class="js-example-placeholder-multiple col-sm-12" name="post_language" id="post_language">
                    <option value="">--Select Language--</option>
                    <option value="hi" {{old('post_language')=='hi' ?'selected':''}}>Hindi</option>
                    <option value="en" {{old('post_language')=='en' ?'selected':''}}>English</option>
                  </select>
                  <p style="color:red; font-weight:bold;" id="post_language_error"></p>

                  @error('post_language')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>

              </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <p>Recommended image size: 738px (W) × 452px (H)</p>
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
                  <a id="removeThumbnail" href="javascript:void(0)" class="btn btn-secondary" style="display:none"><i
                      class="fa fa-trash-o"></i></a>
                </div>
                <div class="form-group">
                  <label class="d-block">Select Main Category:</label>
                  <select class="js-example-placeholder-multiple col-sm-12" multiple="multiple" name="main_category[]"
                    id="main_category">
                    @foreach($main_category as $m_cat)
                    <option value="{{$m_cat->id}}">{{$m_cat->main_category_name_en}}</option>
                    @endforeach
                  </select>
                  <p style="color:red; font-weight:bold;" id="main_category_error"></p>

                  @error('main_category')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="d-block">Select Category:</label>
                  <select class="js-example-placeholder-multiple col-sm-12" multiple="multiple" name="category[]"
                    id="category">

                  </select>
                  @error('category')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="d-block">Select Sub Category:</label>
                  <select class="js-example-placeholder-multiple col-sm-12" multiple="multiple" name="sub_category[]"
                    id="sub_category">
                  </select>
                  @error('sub_category')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>
                @if($user_type == 1 || Auth::user()->is_team == 1)
                <div class="form-group">
                  <label for="validationCustom01">Select Publish Date</label>
                  <input class="form-control" id="post_publish_date" type="date" placeholder="Enter Slug"
                    name="post_publish_date" value="{{old('post_publish_date')}}" max="{{date('Y-m-d')}}">
                  @error('post_publish_date')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>


                <div class="form-group">
                  <label class="d-block">Published by (select user):</label>
                  <select class="js-example-placeholder-multiple col-sm-12" name="post_writer_name"
                    id="post_writer_name">
                    <option value="">--Select--</option>
                    @foreach($user_list as $user) 
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                  @error('post_writer_name')
                  <p style="color:red; font-weight:bold;">{{$message}}</p>
                  @enderror
                </div>
                @elseif($user_type = 2)
                <div class="form-group">
                  <label class="d-block">Published by:</label>
                  <select class="js-example-placeholder-multiple col-sm-12" name="post_writer_name"
                    id="post_writer_name">
                    <option value="{{Auth::user()->id}}" selected>{{Auth::user()->name}}</option>
                  </select>
                </div>
                @endif

              </div> 
                <div id="container">
                        <textarea id="editor" name="blog_detail_editor">{{old('blog_detail_editor')}}</textarea>
                         </div> 

              <div class="btn-showcase">
                <button class="btn btn-primary" type="submit" id="create_submit_btn">Post</button>
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
      document.getElementById('short_description_error').innerText = '';
      document.getElementById('slug_error').innerText = '';
      document.getElementById('post_language_error').innerText = '';

      var slug = document.getElementById('slug').value; 
      var post_language = document.getElementById('post_language').value; 
      if(slug !== '' && post_language !== ''){ 
        $.ajax({
          type: "GET",
              url: "{{route('admin.post.check_create_slug')}}",
              data: {'slug':slug, 'language':post_language},
              success: function(response){
                if(response.message == 'slug_exist' && response.status == 400){
                  $('#slug_error').html("slug already in use");   
                } 
              }
        });
      }
  
      var short_description = tinymce.get('short_description').getContent(); 
      var main_category = document.getElementById('main_category').value; 

      if (short_description.trim() === '') {
        document.getElementById('short_description_error').innerText = 'Short Description is required'; 
        tinymce.get('short_description').focus();
        scrollIntoView('short_description_error');
        return false;  
      }else if (slug === '') {
        document.getElementById('slug_error').innerText = 'Slug is required';
        document.getElementById('slug').focus();
        scrollIntoView('short_description_error');
        return false;  
      }else if (post_language === '') {
        document.getElementById('post_language_error').innerText = 'Plese select language';
        $('#post_language').focus();
        scrollIntoView('post_language');
        return false;  
      }else if (main_category === '') {
        document.getElementById('main_category_error').innerText = 'Plese select main category';
        $('#main_category').focus();
        scrollIntoView('main_category');
        return false;  
      }
      else{
        document.getElementById('create_post_form').submit();
        
      }

      // You can add more complex validation logic here if needed

      // If all validations pass, allow the form to be submitted
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
        const metaKeywordTexts = pastedText.split(/[,]+/).filter(text => text.trim() !== "");
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


    // Select Main Category to show category list (start)
    $("#main_category").change(function ()
    {
      var html_to_append = '';
      const id = $(this).val();
      var token = $('input[name="_token"]').attr('value'); 
      $.ajax({
        url: "{{route('get_categories')}}",
        data: { main_categories: id },
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': token
        },
        success: function (response)
        {
          if (response.status == 200 && response.message == 'success')
          {
            var categories = response.data;
            $("#category").empty();
            $("#sub_category").empty();
            $.each(categories, function (index, category)
            {
              html_to_append += '<option value="' + category.id + '">' + category.category_name_en + '</option>';
            });
            $("#category").append(html_to_append);
          }
        },
      });
    });
    // Select Main Category to show category list (ends)

    $("#category").change(function ()
    {
      var html_to_append = '';
      const id = $(this).val();
      var token = $('input[name="_token"]').attr('value');
      $.ajax({
        url: "{{route('get_sub_categories')}}",
        data: { categories: id },
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': token
        },
        success: function (response)
        {
          if (response.status == 200 && response.message == 'success')
          {
            var sub_categories = response.data;
            $("#sub_category").empty();
            $.each(sub_categories, function (index, sub_category)
            {
              html_to_append += '<option value="' + sub_category.id + '">' + sub_category.sub_category_name_en + '</option>';
            });
            $("#sub_category").append(html_to_append);
          }
        },
      });

    }); 
    });

  
</script>

     <script>
  tinymce.init({
    selector:
      '#short_description'
  });
</script>

<script>

  $(document).ready(function(){
    $(document).on('keyup', '#slug', function(){
      let slug = $(this).val();   
      let language = $('#post_language').val();    

      $.ajax({
          type: "GET",
              url: "{{route('admin.post.check_create_slug')}}",
              data: {'slug':slug, 'language':language},
              success: function(response){
                if(response.message == 'slug_exist' && response.status == 400){
                  $('#slug_error').html("slug already in use"); 
                  $('#create_submit_btn').prop('disabled', true);
                }else{
                  $('#slug_error').html(""); 
                  $('#create_submit_btn').prop('disabled', false);
                }  
              }
        });
  });

  $(document).on('change', '#post_language', function(){
  
        document.getElementById('post_language_error').innerText = '';
         

      let slug = $('#slug').val();  
      let language = $(this).val();   

  console.log(slug);
      $.ajax({
          type: "GET",
              url: "{{route('admin.post.check_create_slug')}}",
              data: {'slug':slug, 'language':language},
              success: function(response){
                if(response.message == 'slug_exist' && response.status == 400){
                  $('#slug_error').html("slug already in use"); 
                  $('#create_submit_btn').prop('disabled', true);
                  console.log(response)
                }else{
                  $('#slug_error').html(""); 
                  $('#create_submit_btn').prop('disabled', false);
                }  
              }
        });

  });

});
  </script>
 
@endsection