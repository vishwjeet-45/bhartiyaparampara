<!-- Footer -->
@php
$main_category_name = 'main_category_name_'.Session::get('lang');
$pdf_page_name = 'page_name_'.Session::get('lang');
$top_header_menu_page_name = 'main_category_name_'.Session::get('lang');
$lang = Session::get('lang');
@endphp


<style>
  .top-header-btn:hover{
    color: #000 !important;
    background-color: #fff !important;
  } 
  .social{
        margin:  3px !important;
  }
</style>
<!---------------------------------------------------- Bottom ads verticle(larg) start  --------------------------------------------------------->
<div class="text-center pb-48">
    @if(!empty($bottom_ads_large))
    @foreach($bottom_ads_large as $ads)
    <a href="{{$ads->target_url != '' ? $ads->target_url : '#'}}" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
    @endforeach
    @endif
</div>
<!--------------------------------------------------- Bottom ads verticle(larg) end  --------------------------------------------------------->

<!------------------------------------------------------- Top Verticle Google ads (large) - (start) -------------------------------------------------->

<!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> 
  <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9148274628956787"
     data-ad-slot="8363607966"
     data-ad-format="auto"
     data-full-width-responsive="true">
    </ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script> -->
<!------------------------------------------------------- Top Verticle Google ads (large) - (end) -------------------------------------------------->

<img src="{{url('public/build/assets/frontend/img/bottom-india.png')}}">
<footer class="footer footer--dark">
  <div class="container">
    <div class="footer__widgets">
      <div class="row">

        <div class="col-lg-3 col-md-6">
          <aside class="widget widget-logo">
            <a href="/"> 
            @if($lang == 'hi')
            <img src="{{url('public/build/assets/frontend/img/name.png')}}" alt="Bhartiya Parampara"
                style="margin-top:-15px;">
                  @else 
                  <img src="{{url('public/build/assets/frontend/img/logo-en.png')}}" alt="Bhartiya Parampara" style="margin-top:-15px;">
                  @endif
            </a>
            <p align="justify">
              <font color="#FFFFFF">{{$lang == 'en'?'India is a land of culture and traditions. Across the length and breadth of country every state, city, town has different traditions which are being followed up since ancient times. We would further invite guests who would like to contribute in our journey on spreading the knowledge and keeping intact the Cultures of India.':'भारत संस्कृति और परंपराओं का देश है। देश के हर राज्य की लंबाई और चौड़ाई के आधार पर
              राज्यों, नगरों और गाँवो में अलग-अलग परंपराएं चली आ रही हैं, जिनका प्राचीन काल से पालन किया जा रहा है। हम
              उन मेहमानों को आमंत्रित करते जो ज्ञान के प्रसार और भारतीय संस्कृति को अक्षुण्ण रखने पर हमारी यात्रा में
              योगदान देना चाहेंगे।'}} </font>
            </p>
            <div class="email mt-4">
              <h4 class="widget-title mb-0 "> {{$lang == 'hi'?'संपर्क सूत्र':'Email Us'}}</h4>
              <p class="newsletter__text">
                <i class="ui-email newsletter__icon" style="color: #fff;"></i>
               <a href="mailto:paramparabhartiya@gmail.com"><font color="#ef4029"> paramparabhartiya@gmail.com</font></a>
              </p>
            </div> 
          </aside>
        </div>
        <div class="col-lg-2 col-md-6">
          <aside class="widget widget_nav_menu">
            <h4 class="widget-title">{{$lang == 'hi'?'उपयोगी लिंक':'Useful Links'}}</h4>  
            <ul>
            @foreach($main_categories as $m_category)
              <li><a href="
                 @if($m_category->page_type == '0')
                 {{route('frontend.post_list', [Str::slug($m_category->main_category_name_en)])}}
                 @elseif($m_category->page_type == '1')
                 {{route('frontend.post_list', [Str::slug($m_category->main_category_name_en)])}}
                 @elseif($m_category->page_type == '3')
                 {{route('frontend.post_list', [Str::slug($m_category->main_category_name_en)])}}
                  @elseif($m_category->page_type == '4')
                 {{route('frontend.post_list', [Str::slug($m_category->main_category_name_en)])}}
                 @else 
                  {{route('frontend.view.page', [Str::slug($m_category->main_category_name_en)])}} 
                  @endif
                 ">{{$m_category->$main_category_name}}</a></li> 
              @endforeach
            </ul>
          </aside>
        </div>

        <div class="col-lg-2 col-md-6">
          <aside class="widget widget_nav_menu">
            <h4 class="widget-title">{{$lang == 'hi'?'सामान्य लिंक':'General Links'}}</h4>
            <ul> 
              @foreach($pdf_page_list as $pdf_page) 
              <li><a href="{{route('frontend.pdf_page.index', [$pdf_page->slug])}}">{{$pdf_page->$pdf_page_name}}</a></li>
              @endforeach
              @php
              $top_menu = App\Models\backend\MainCategory::where('main_category_status', 1)->where('page_type',
              3)->get();
              @endphp
              @foreach($top_menu as $menu)
              <li><a href="{{route('frontend.post_list', [Str::slug($menu->main_category_name_en)])}}">{{$menu->$top_header_menu_page_name}}</a></li>
              @endforeach 
              <li><a href="{{route('frontend.question.index')}}">{{$lang == 'hi'?'सवाल-जवाब':'Question & Answer'}}</a></li>
              <li><a href="{{route('frontend.gallery.view')}}">{{$lang == 'hi'?'गैलरी':'Gallery'}}</a></li>
            </ul>
          </aside>
        </div>
        <div class="col-lg-2 col-md-6">
          <aside class="widget widget_nav_menu">
            @php
            $other_pages = App\Models\backend\OtherPage::where('page_status', 1)->where('page_language',
            Session::get('lang'))->get();
            @endphp
            <h4 class="widget-title">{{$lang == 'hi'?'अन्य लिंक':'Other Links'}}</h4>
            <ul>
              @foreach($other_pages as $page)
              <li><a href="{{route('frontend.other_page.single', [$page->slug])}}">{{$page->page_name}}</a></li>
              @endforeach
              <li><a href="{{route('frontend.team.list')}}">{{$lang == 'hi'?'टीम':'Team'}}</a></li> 
              <!-- <li><a href="{{route('frontend.gallery.view')}}">{{$lang == 'hi'?'गैलरी':'Gallery'}}</a></li> -->
            </ul>
          </aside>
        </div>
        <div class="col-lg-3 col-md-6">
          <aside class="widget widget_mc4wp_form_widget">
            
            <div>
              <form method="POST" action="{{route('frontend.subscribe_newsletter')}}">
                @csrf
                <h4 class="widget-title">{{$lang == 'hi'?'सब्सक्राइब हमारा न्यूज़लेटर':'Subscribe our newsletter'}} </h4>
                <input type="email" name="email" placeholder="Enter your email">
                @error('email')
                <p style="color:red !important;">{{$message}}</p>
                @enderror
                <button type="submit" class="btn btn-primary top-header-btn">{{$lang == 'hi'?'सब्सक्राइब':'Subscribe'}} </button>
              </form><br>

            </div>
            <h4 class="widget-title">{{$lang == 'hi'?'सोशल मीडिया कनेक्शन':'Social Connection'}}</h4>
            <div class="socials socials--large socials--rounded mb-24">

              @if($social_media->whatsapp_status == 1)
              <a class="social social-whatsapp" href="{{$social_media->whatsapp}}" target="_blank"
                aria-label="whatsapp">
                <i class="ui-whatsapp"></i>
              </a>
              @endif

              @if($social_media->telegram_status == 1)
              <a class="social social-telegram icoex" href="{{$social_media->telegram}}" target="_blank"
                aria-label="telegram">
                <i class="fab fa-telegram"></i>
              </a>
              @endif

              @if($social_media->youtube_status == 1)
              <a class="social social-youtube" href="{{$social_media->youtube}}" target="_blank" aria-label="youtube">
                <i class="ui-youtube"></i>
              </a>
              @endif

              @if($social_media->linkedin_status == 1)
              <a class="social social-linkedin" href="{{$social_media->linkedin}}" target="_blank"
                aria-label="linkedin">
                <i class="ui-linkedin"></i>
              </a>
              @endif

              @if($social_media->x_status == 1)
              <a class="social social-x icoexx" href="{{$social_media->x}}" target="_blank" aria-label="x">
                <i class="fa-brands fa-x-twitter"></i></i>
              </a>
              @endif

              @if($social_media->facebook_status == 1)
              <a class="social social-facebook" href="{{$social_media->facebook}}" target="_blank"
                aria-label="facebook">
                <i class="ui-facebook"></i>
              </a>
              @endif

              @if($social_media->instagram_status == 1)
              <a class="social social-instagram" href="{{$social_media->instagram}}" target="_blank"
                aria-label="instagram">
                <i class="ui-instagram"></i>
              </a>
              @endif

              @if($social_media->thread_status == 1)
              <a class="social social-thread icoexx " href="{{$social_media->thread}}" target="_blank"
                aria-label="thread">
                <i class="fa-brands fa-threads"></i>
              </a>
              @endif

            </div>


          </aside>
        </div>
      </div>
    </div>
  </div> <!-- end container -->
</footer> <!-- end footer -->
<div class="bot">
@if($lang == 'hi') 
©2020, सभी अधिकार भारतीय परम्परा द्वारा आरक्षित हैं।
<a href="http://www.mxcreativity.com/" target="_blank" rel="nofollow">MX Creativity</a> के द्वारा संचालित है |
@else 
©2020, All rights are reserved by Bhartiya Parampara. Powered by <a href="http://www.mxcreativity.com/" target="_blank" rel="nofollow">MX Creativity</a> 
@endif
              </div>
 
<div id="back-to-top">
  <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
</div>

</main> <!-- end main-wrapper -->


<!-- jQuery Scripts -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{url('public/build/assets/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{url('public/build/assets/frontend/js/owl-carousel.min.js')}}"></script>
<script src="{{url('public/build/assets/frontend/js/flickity.pkgd.min.js')}}"></script>
<script src="{{url('public/build/assets/frontend/js/twitterFetcher_min.js')}}"></script>
<script src="{{url('public/build/assets/frontend/js/jquery.newsTicker.min.js')}}"></script>
<script src="{{url('public/build/assets/frontend/js/modernizr.min.js')}}"></script>
<script src="{{url('public/build/assets/frontend/js/scripts.js')}}"></script>
<script>
document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});
</script>


@if(Session::has('newsletter_subscribed'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('newsletter_subscribed'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif

 


@if(Session::has('register_success_writer'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Success",
      text: "{{(Session::get('register_success_writer'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif

@if(Session::has('register_success_user'))
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Congratulations!",
      text: "{{(Session::get('register_success_user'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@endif


@error('email')
<script type="text/javascript">
  $(document).ready(function ()
  {
    swal({
      title: "Failed",
      text: "{{$message}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@enderror

<script>
  const nav__search_container = document.getElementById('nav__search-box');
  const searchBox = document.getElementById('search-input');
  searchBox.addEventListener('keyup', function (event)
  {
    let search_val = searchBox.value;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('frontend.search-certificates')}}",
      type: "POST",
      data: { 'search_val': search_val },
      success: function (response)
      {
          console.log(response);
        const oldAnchor = document.getElementById('search_ancher');
        if (oldAnchor)
        {
          oldAnchor.innerHTML = (search_val.trim() === '') ? '' : response;
        } else
        {
          oldAnchor.insertAdjacentHTML('beforeend', response);
        }
      },
    });

  });

</script>
<script>
  var myIndex = 0;
  carousel();

  function carousel()
  {
    var i;
    var x = document.getElementsByClassName("myfun");
    for (i = 0; i < x.length; i++)
    {
      x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) { myIndex = 1 }
    x[myIndex - 1].style.display = "block";
    setTimeout(carousel, 3000);
  }
</script>

    <script>
      // $(function ()
      // { 
      //   createSticky($("#header-top-set")); 
      // });

      // function createSticky(sticky){ 
      //   if (typeof sticky !== "undefined")
      //   { 
      //     var pos = sticky.offset().top + 20,
      //       win = $(window);
      //     delay = 500;

      //     win.on("scroll", function ()
      //     {
      //       win.scrollTop() >= pos ? sticky.addClass("fixed-hed") : sticky.removeClass("fixed-hed");
      //     });
      //   }
      // }
    </script>

<script>
      // Wait for the DOM to be ready
      document.addEventListener('DOMContentLoaded', function (){
        // Get the li element with the class 'dropdown-trigger'
        var dropdownTrigger = document.querySelector('.dropdown-trigger');

        // Attach a click event listener to the li element
        dropdownTrigger.addEventListener('click', function (){
          // Toggle the 'active' class on the dropdown-content div
          this.querySelector('.dropdown-content').classList.toggle('active');
        });
      });
    </script>

    <script>
      $(document).ready(function ()
      {
        var header = $('.header');
        var stickyHeaderOffset = header.offset().top;
        var minScrollValue = 50; // Adjust this value based on your requirement
         var logo = document.querySelector('.logo__img');

        $(window).scroll(function ()
        {
          var currentScroll = window.pageYOffset;

          if (currentScroll > stickyHeaderOffset)
          {
            header.addClass('scrolling');

            // Check if the scroll position is beyond the minimum value
            if (currentScroll > minScrollValue)
            {
              header.addClass('sticky-header');
              logo.style.maxWidth = '80%';
            } else
            {
              header.removeClass('sticky-header');
               logo.style.maxWidth = '100%';
            }
          } else
          {
            header.removeClass('sticky-header scrolling');
            logo.style.maxWidth = '100%';
          }
        });
      }); 
    </script>

    <script>
      function toggleDropdown(dropdownId)
      { 
        var dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle('show');
      }
    </script>

    <script>

document.addEventListener('DOMContentLoaded', function (){
  var storedValue = localStorage.getItem('menuId');
  if (window.location.href.includes(storedValue)) { 
  var activeMenuItems = document.getElementsByClassName(storedValue);
  for (var i = 0; i < activeMenuItems.length; i++) {
      activeMenuItems[i].classList.add('active');
    }
  }


}); 
function activeFrontMenu(menuId){
  // var menuItems = document.querySelectorAll('.nav__dropdown'); 
  localStorage.setItem('menuId', menuId);
}


 


</script>
@yield('javascript-section')
</body>

</html>