@extends('layouts/backend/main')
@section('main-section') 
@php
$user_type = Auth::user()->user_type;
@endphp

                       <!-- Include stylesheet -->
                       
        <style>
  .tox-notifications-container,
  .tox-statusbar {
    display: none !important;
  }

  .tox-menu .tox-collection .tox-collection--list .tox-selected-menu,
  .tox-collection__group {
    min-width: 230px !important;
  }
  
  .editor_box{
      margin-bottom:16px;
  }
</style>               


        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Edit Profile</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.login.view')}}"><i data-feather="home"></i></a></li>
                    <!-- <li class="breadcrumb-item">@if(Auth::user()->user_type == 1)
                      Admin
                      @elseif(Auth::user()->user_type == 2)
                      Writer
                      @elseif(Auth::user()->user_type == 3)
                      User
                      @endif
                    </li> -->
                    <li class="breadcrumb-item active">Edit Profile</li>
                  </ol>
                </div>
                 
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
                <div class="col-xl-4">
                  <div class="card">
                    <div class="card-header pb-0">
                      <h4 class="card-title mb-0">My Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div>
                        <div class="row mb-2">
                          <div class="profile-title">
                            <div class="media">                  
                           <img class="img-70 rounded-circle" alt="" src="{{url('public/build/assets/upload/user/profile_image')}}/{{$user_detail->profile_image != '' ? $user_detail->profile_image:'default_user.png'}}">
                              <div class="media-body">
                                <h3 class="mb-1 f-20 txt-primary">{{$user_detail->name}}</h3>
                                @if($user_detail->user_type == 1)
                                <p>Admin</p>
                                @elseif($user_detail->user_type == 2)
                                <p>Writer</p>
                                @elseif($user_detail->user_type == 3)
                                <p>User</p>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                          
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-8">
                  <form class="card" action="{{$user_detail->user_type == 2?route('admin.writer.update', [$user_detail->id]):route('admin.user.update', [$user_detail->id])}}" method="POST" enctype="multipart/form-data">
                  @csrf  
                  <div class="card-header pb-0">
                      <h4 class="card-title mb-0">Edit Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                      <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Enter User Name" value="{{$user_detail->name}}">
                          </div>
                        </div>
                      <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Email" value="{{$user_detail->email}}">
                          </div>
                        </div>
                        
                        @if($user_detail->user_type == 2)
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Account Status</label>
                            <select class="form-control btn-square" name="account_status" id="account_status"> 
                              <option value="0" {{$user_detail->writer_account_status == 0 ? 'selected':''}}>Rejected</option>
                              <option value="1" {{$user_detail->writer_account_status == 1 ? 'selected':''}}>Approved</option>
                              <option value="2" {{$user_detail->writer_account_status == 2 ? 'selected':''}}>Pending</option> 
                            </select>
                          </div>
                        </div>
                        @endif

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-control btn-square" name="gender" id="gender"> 
                              <option value="Male" {{$user_detail->gender == 'Male' ? 'selected':''}}>Male</option>
                              <option value="Female" {{$user_detail->gender == 'Female' ? 'selected':''}}>Female</option>
                              <option value="Other" {{$user_detail->gender == 'Other' ? 'selected':''}}>Other</option> 
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input class="form-control" type="number" name="phone_number" id="phone_number" placeholder="Enter Phone Number" value="{{$user_detail->phone_number}}">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">City</label>
                            <input class="form-control" type="text" name="city" id="city" placeholder="Enter City" value="{{$user_detail->city}}">
                          </div>
                        </div>
                        
                        <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Upload Profile Picture</label>
                            <input class="form-control"  type="file" name="profile_picture" id="profile_picture">
                            <p>Recommended image size: 300px (W) × 300px (H)</p>
                            @error('profile_picture')
                                <p style="color:red;">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>

                        @if($user_detail->user_type == 2)
                        <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Upload Certificate</label>
                            <input class="form-control"  type="file" name="certificate" id="certificate">
                          </div>
                        </div>
                        @endif
                        
                        <div class="col-md-12">
                          <div class="editor_box">
                            <label class="form-label">Profile (en)</label>
                          
                         
                          <textarea class="form-control" row="5" col="5" name="bio_en" id="bio_en" placeholder="Enter About yourself">{{$user_detail->bio_en}}</textarea>
                        
                          
                        </div>
                     
                          
                        </div>
                        
                         


                        <div class="col-md-12">
                          <div class="editor_box">
                            <label class="form-label">Profile (hi)</label>
                        
                         
                          <textarea class="form-control" row="5" col="5" name="bio_hi" id="bio_hi" placeholder="Enter About yourself">{{$user_detail->bio_hi}}</textarea>
                        
                          
                        </div>
                        </div>

                        @if($user_detail->user_type == 2)
                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Meta Title (Hindi)</label>
                            <input class="form-control" type="text" name="meta_title_hi" id="meta_title_hi" placeholder="Enter Meta Title" value="{{$user_detail->meta_title_hi}}">

                           </div>
                        </div>

                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Meta Description (Hindi)</label>
                            <textarea class="form-control" rows="5" name="meta_description_hi" id="meta_description_hi" placeholder="Enter Meta Description">{{$user_detail->meta_description_hi}}</textarea>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Meta Title (English)</label>
                            <input class="form-control" type="text" name="meta_title_en" id="meta_title_en" placeholder="Enter Meta Title (en)" value="{{$user_detail->meta_title_en}}">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Meta Description (English)</label>
                            <textarea class="form-control" rows="5" name="meta_description_en" id="meta_description_en" placeholder="Enter Meta Description (English)">{{$user_detail->meta_description_en}}</textarea>
                          </div>
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="card-footer text-end pt-0">
                      <button class="btn btn-primary" type="submit">Update Profile</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
          
       
      

@endsection

@section('javascript-section')

<script>
 

</script>

<script>
        
           CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                ckfinder: {
          uploadUrl: '{{$user_type == 2 ? route("admin.ckeditor.upload", ["_token" => csrf_token()]) : route("writer.ckeditor.upload", ["_token" => csrf_token()]) }}',
          
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
  tinymce.init({
    selector:
      '#bio_en',
     
  });
  
    tinymce.init({
    selector:
       '#bio_hi',
     
  });
  
</script>
       




@endsection
