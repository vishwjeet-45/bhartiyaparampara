<!-- footer start-->
<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 footer-copyright text-center">
        <p class="mb-0">Copyright 2020 © Bhartiya Parampara All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- tap on top starts-->
<div class="tap-top"><i class="icon-control-eject"></i></div>
<!-- tap on tap ends-->
</div>
</div>
<!-- latest jquery-->
<script src="{{url('public/build/assets/backend/js/jquery-3.5.1.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{url('public/build/assets/backend/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{url('public/build/assets/backend/js/sidebar-menu.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/config.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{url('public/build/assets/backend/js/bootstrap/popper.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/bootstrap/bootstrap.min.js')}}"></script>
<!-- Plugins JS start-->
<script src="{{url('public/build/assets/backend/js/chart/chartjs/chart.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/chart/chartist/chartist.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/chart/morris-chart/raphael.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/chart/morris-chart/morris.js')}}"> </script>
<script src="{{url('public/build/assets/backend/js/chart/morris-chart/prettify.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/chart/knob/knob.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/prism/prism.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/counter/counter-custom.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/custom-card/custom-card.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/dashboard/default.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/notify/index.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/greeting.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<!-- <script src="{{url('public/build/assets/backend/js/theme-customizer/customizer.js')}}"></script> -->
<!-- login js-->
<!-- <script src="{{url('public/build/assets/backend/js/editor/ckeditor/adapters/jquery.js')}}"></script> -->
<!-- <script src="{{url('public/build/assets/backend/js/dropzone/dropzone.js')}}"></script> -->
<!-- <script src="{{url('public/build/assets/backend/js/dropzone/dropzone-script.js')}}"></script> -->
<script src="{{url('public/build/assets/backend/js/select2/select2.full.min.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/select2/select2-custom.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/form-validation-custom.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/script.js')}}"></script>


<!-- ck editor start -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>
<script src="{{url('public/build/assets/backend/easyimage/plugin.js ')}}"></script>

<!-- <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script> -->
<!-- ck editor end -->


<!-- summber note eidtor start -->


<!-- <script src="{{url('public/build/assets/backend/js/editor/summernote/summernote.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/editor/summernote/summernote.custom.js')}}"></script>
<script src="{{url('public/build/assets/backend/js/jquery.ui.min.js')}}"></script> -->
<!-- summber note eidtor end -->

<!-- Plugin used-->

<!-- Sweet Alert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<!-- tiny eidtor start -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/codemirror.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/htmlmixed/htmlmixed.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/javascript/javascript.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/xml/xml.js'></script>
          <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>   -->
<!-- tiny editor end -->

@yield('javascript-section')

<script>
  $(document).ready(function ()
  {
    $(document).on("click", ".modal_notification", function ()
    {
      var id = $(this).data('id');
      var $this = $(this);  // Define $this
      $.ajax({
        type: "GET",
        url: "{{route('notification.read_notification')}}",
        data: { 'id': id },
        success: function (response)
        {
          if (response.status == 200 && response.message == 'read')
          {
            var li = $this.closest('li');
            li.removeClass('unread_notification');
            li.addClass('read_notification');
            $('#noti_title').text(response.data.title);
            $('#noti_desc').text(response.data.description);
          }
        }
      });
    });


    $(document).on("keyup", ".search_bar", function ()
    {
      var searchKey = $(this).val();
      var topSearchList = $('.top_search_list');
      $.ajax({
        type: "GET",
        url: "{{route('panel_search')}}",
        data: { 'searchKey': searchKey },
        success: function (response)
        {
          if (searchKey !== '')
          {
            topSearchList.empty();
            topSearchList.append(response);
          } else
          {
            topSearchList.empty();
          }
        }
      });


    });
  });
</script>



<script>
  $(document).ready(function ()
  {
    $('#searchInput').on('focus', function ()
    {
      $('.dropdown-onclick').show();
    });

    $('#searchInput').on('blur', function ()
    {
      // Delay hiding the dropdown to allow the user to click on it
      setTimeout(function ()
      {
        $('.dropdown-onclick').hide();
      }, 200);
    });

    // Prevent hiding when clicking on the dropdown itself
    $('.dropdown-onclick').on('click', function (e)
    {
      e.stopPropagation(); // Prevent the blur event from triggering
    });
  });
</script>
</body>

</html>