@extends('layouts/frontend/main') 
@php
$lang = Session::get('lang');
$question_column = 'question_'.$lang;
@endphp
@section('meta-title')
@if($lang == 'hi')
सत्य तथ्यों के प्रश्न और उत्तर - ज्ञान से भरा हिन्दी स्रोत 
@else
Questions and answers of true facts - Source full of knowledge
@endif
@endsection

@section('meta-description')
@if($lang == 'hi')
भारतीय परंपरा सत्य तथ्यों के प्रश्नों और उत्तरों के माध्यम से आपको भारतीय विरासत, संस्कृति और परंपरा के गहरे सिद्धांतों के आधार पर शिक्षित करती है। भारतीय धार्मिकता, साहित्य, कला, धरोहर और रुचिकर जानकारी से सराबोर करती है।
@else
Indian Traditions educates you on the deep principles of Indian heritage, culture and tradition through true facts, questions and answers. It is full of Indian religion, literature, art, heritage and interesting information.
@endif
@endsection

@section('main-section')


<style>
  .card-header {
       background-color: #f3f3f3;
    color: #000 !important;
    padding: 10px;
    border-radius: 10px;
    box-shadow: none;
    border: 1PX solid #dddddd !important;
  }
  #cardnon{
    border-radius: 0 !important;
    background: #ffff;
    border: 0;
  }
  .title { 
    color: #fff !important;
  }
  .q-color{
        color: #ef4029;
  }
  .card-header .title{
        color: black !important;
  }
  .card-header .title:hover{
            color: #ef4029 !important;
  }
</style>

<!--Section: FAQ-->

<section class="main-content pt-5 "> <div class="container"> <div class="row">
  <div class="col-lg-8 blog__content mb-72">

  <div class="accordion mb-3" id="accordionExample" style="box-shadow:none;">
  @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count = $page_number * 10 - 9;  @endphp 

    @foreach($q_and_a_list as $q_and_a)
    <div class="container">
      <div class="row">
      <div class="card" id="cardnon" style="    padding: 11px 13px;
    background: #f7f7f7 !important;">
      <div class="card-header collapsed" data-toggle="collapse" data-target="#collapse_{{$q_and_a->id}}" aria-expanded="true">
        <span class="title"><b class="q-color">Q. {{$count++}} </b> {{$q_and_a->$question_column}} -
        <b>({{$q_and_a->mainCategory->main_category_name_en}})</b></span>
        <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
      </div>
      <div id="collapse_{{$q_and_a->id}}" class="collapse" data-parent="#accordionExample">
      <div class="card-body">
      @if(Auth::check())
      @if(Auth::user()->is_block == 0)
      <form action="{{route('frontend.question.post')}}" method="POST">
      @csrf
      <input type="hidden" name="q_id" id="q_id" value="{{$q_and_a->id}}">
      <div class="mb-3 mt-3">
      <label for="message" class="form-label">Write you answer:</label>
      <textarea class="form-control" id="answer" name="answer" rows="4" placeholder="Type here..."></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Send</button>
      </form>
      @else
      <p style="color:red;"><b>You account is blocked</b></p>
      @endif

      @else
      <p><a href="{{route('user.login.view', ['redirect' => url()->current()])}}">Login</a> to write your answer</p>
      @endif

      @foreach($q_and_a->answers as $answer)
      <div class="user d-flex mt-3">
        <img src="{{url('public/build/assets/upload/user/profile_image')}}/{{$answer->user->profile_image ==
        ''?'default_user.png':$answer->user->profile_image}}" class="mr-3 rounded" alt="User Avatar" width="50"
        height="25">
        <p class="fw-bolder">{{$answer->user->name}}</p>
      </div>
      <p><b class="px-3" style="color: #279b27;;">Ans.</b> {{$answer->answer}}</p><hr>
      @endforeach
      </div>
      </div>
    </div>
    </div>
    </div>
    @endforeach

  
  </div>
  <div class="my_pagination">
   {{ $q_and_a_list->links('pagination::bootstrap-4') }}
  </div>
  </div> 
  <aside class="col-lg-4 sidebar sidebar--right">
  <!-- Top Square ads (small) - (start)-->
  <aside class="widget widget_media_image"> 
            @if(!empty($top_ads_small))
                @foreach($top_ads_small as $ads)
                    <a href="" target="_blank"><img src="{{url($ads->image)}}" alt="{{$ads->title}}"> </a><br><br>
                @endforeach
            @endif    
        </aside> 
        <!-- Top Square ads (small) - (end)-->
        <aside class="widget widget-rating-posts">
                <h4 class="widget-title">{{$lang == 'hi'?'आध्यात्मिक संग्रह':'Spiritual Collection'}}</h4>
                @foreach($spiritual_collection_pdf as $s_c_pdf)
                <article class="entry">
                    <div class="entry__img-holder">
                        <a>
                            <div class="thumb-container thumb-60">
                                <img src="{{url('public/build/assets/upload/thumbnail/pdf_file_thumbnail')}}/{{$s_c_pdf->thumbnail ?? ''}}"
                                    class="entry__img lazyload" alt="Corona Effect">
                            </div>
                        </a>
                    </div>
                    <div class="entry__body">
                        <div class="entry__header">
                            <h2 class="entry__title">
                                <a href="{{url('public/magazine')}}/{{$s_c_pdf->year}}/{{$s_c_pdf->pdf_file}}"
                                    target="_blank">{{$s_c_pdf->pdf_file_title ?? ''}}</a>
                            </h2>
                        </div>
                    </div>
                </article>
                @endforeach
            </aside>
    <!-- middle ads square(small) start  -->
    <div class="text-center pb-48">
                @if(!empty($middle_ads_small))
                @foreach($middle_ads_small as $ads)
                <a href="" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
                @endforeach
                @endif 
                </div>  
                <!-- middle ads square(small)  end  -->
      <!-- Widget Popular Posts -->
      <aside class="widget widget-popular-posts">
        <h4 class="widget-title">{{$lang == 'hi' ? 'लोकप्रिय लेख' : 'Popular Artical'}}  </h4>
        <ul class="post-list-small">
          @foreach($popular_post as $popular)
          <li class="post-list-small__item">
            <article class="post-list-small__entry clearfix">
              <div class="post-list-small__img-holder">
                <div class="thumb-container thumb-100">
                  <a href="{{route('frontend.view.post', [Str::slug($popular->getuser->name), $popular->slug])}}" target="_blank">
                    <img src="{{url('public/build/assets/upload/thumbnail')}}/{{$popular->thumbnail_image}}"
                      alt="{{$popular->meta_title}}" class=" lazyload">
                  </a>
                </div>
              </div>
              <div class="post-list-small__body">
                <h3 class="post-list-small__entry-title">
                  <a href="{{route('frontend.view.post', [Str::slug($popular->getuser->name), $popular->slug])}}"
                    target="_blank">{{$popular->meta_title}}</a>
                </h3>
                <ul class="entry__meta">
                  <li class="entry__meta-author">
                    <a href="{{route('frontend.writer_profile', [Str::slug($popular->getUser->name), $popular->getUser->id])}}"
                      target="_blank">{{$popular->getUser->name}}</a>
                  </li>
                  <li class="entry__meta-date">
                    {{date('M j, Y', strtotime($popular->publish_on))}}
                  </li>
                </ul>
              </div>
            </article>
          </li>
          @endforeach

        </ul>
      </aside>  
 
       <!-- bottom ads square(small) end  --> 
       <aside class="widget widget_media_image">
            @if(!empty($bottom_ads_small))
                @foreach($bottom_ads_small as $ads)
                <a href="" target="_blank"> <img src="{{url($ads->image)}}" alt="{{$ads->title}}"></a>
                @endforeach
                @endif 
            </aside>  
       <!-- bottom ads square(small) end  -->  


    </aside>


  
</div> 
</div>
  </div> 
</section>

  <!--Section: FAQ-->
@section('javascript-section')
@if(Session::has('q_post_success'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "In Review",
      text: "{{(Session::get('q_post_success'))}}",
      icon: "success",
      button: "Ok"
    });
  });
</script>
@elseif(Session::has('q_post_fail'))
<script type="text/javascript">
  $(document).ready(function () {
    swal({
      title: "Failed",
      text: "{{(Session::get('q_post_fail'))}}",
      icon: "error",
      button: "Ok"
    });
  });
</script>
@endif
@endsection
@endsection