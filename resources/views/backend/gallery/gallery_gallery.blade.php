@extends('layouts/frontend/main')
@php
$lang = Session::get('lang');
$title_column_name = "title_".$lang;
@endphp
@section('meta-title')
@if($lang == 'hi')
भारतीय परम्परा के समृद्ध क्षणों का संग्रह और छवियों की स्मृतियाँ 
@else
Bhartiya Parampara Photo Gallery: Capturing Moments, Creating Memories
@endif
@endsection

@section('meta-description')
@if($lang == 'hi')
हमारा फोटो गैलरी पृष्ठ - समृद्ध क्षणों का संग्रह और छवियों की स्मृतियाँ उकेरते हुए हर अनुभव की एक यादगार कहानी बनता है।
@else
Our Photo Gallery page – a collection of rich moments and images creating a memorable story of every experience.
@endif
@endsection



@section('main-section')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style>
    .tabs-vi {
        display: flex;
        justify-content: center;
    }

    .tab {
        display: flex;
        border-bottom: 2px solid #ccc;
        overflow: hidden;
        display: block !important;
        border: 0 !important;
        background-color: transparent !important;
    }
    .tab button h3{
        margin-bottom: 3px;
    }

    .tab-btn {
        flex: 1;
        text-align: center;
        padding: 10px;
        cursor: pointer;
        background-color: #f0f0f0;
       
        border-bottom: none;
        display: flex;
        justify-content: center;
        background-color: #000 !important;
    }

     
    .tab-btn:hover {
        background-color: #ddd;
    }

    .tab-btn.active {
        background-color: #eb3f28 !important;
         border: none;
       
    }

    .tabcontent {
        display: none;
        /* padding: 20px; */
        /* border: 1px solid #000; */
      /* box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; */
       
    }

    .tab-img-content img {
        object-fit: cover;
        height: 200px;
        width: 100%;
    }

    button h3 {
        color: #fff;
    }

    .nav {
        justify-content: center;
    }

    .nav__holder {
        width: 100%;
    }

    .carousel-control-prev {
        left: -86px;
    }

    .carousel-control-next {
        right: -86px;
    }

    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        padding: 5px 15px;
        transition: 0.3s;
    }

    button h3 {
        font-size: 14px;
    }

    /* .top-header-btn {
        background-color: red;
        border: 0;
        color: #fff;
        margin-top: 15px;
        padding: 0px 8px;
        font-weight: 800;
    } */
    video {
    height: 89%;
    width: 100%;
}
</style>

<div class="container">
    <div class="tabs-vi-content mt-3">
        <div class="tab ">
           
            <button class="tablinks tab-btn  " onclick="openCity(event, 'images')">
                <h3>Images</h3>
            </button>
            <button class="tablinks tab-btn mx-2" onclick="openCity(event, 'videos')">
                <h3>Videos</h3>
            
            </button>
          
        </div>


        <div id="videos" class="tabcontent">
            <!-- <h3 class="text-center">Videos</h3> -->
            <div class=" row inner-video d-flex ">
                <!-- <div class="row  ">  -->
                @foreach($galleryItems as $item)
                @if($item->type == 'video')
                <div class="col-md-4 my-1">
                    <video width="auto" height="100" controls>
                        <source src="{{ $item->file_path }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h6>{{$item->$title_column_name}}</h6>
                </div>
                @endif
                @endforeach
                <!-- </div> -->
            </div>
        </div>

        <div id="images" class="tabcontent tab-img ">
            <!-- <h3 class="text-center">Images</h3> -->
            <div class="inner-img d-flex justify-content-center">
                <div class="row">
                    @foreach($galleryItems as $index => $item)
                    @if($item->type == 'image')
                    <div class="col-md-4 my-1 tab-img-content">
                        <a href="#" data-toggle="modal" data-target="#imageModal{{$index}}">
                            <img src="{{$item->file_path}}" alt="{{$item->$title_column_name}}">
                        </a>
                        <h6 class="my-2">{{$item->$title_column_name}}</h6>
                    </div>

                    <!-- Bootstrap Modal -->
                    <div class="modal fade" id="imageModal{{$index}}" tabindex="-1" role="dialog"
                        aria-labelledby="imageModalLabel{{$index}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Image Carousel -->
                                    <div id="carouselExample{{$index}}" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($galleryItems as $carouselIndex => $carouselItem)
                                            @if($carouselItem->type == 'image')
                                            <div class="carousel-item {{$carouselIndex === $index ? 'active' : ''}}">
                                                <img src="{{$carouselItem->file_path}}" class="d-block w-100"
                                                    alt="{{$carouselItem->$title_column_name}}">
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExample{{$index}}" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExample{{$index}}" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom JavaScript to control the carousel manually -->
<script>
    $(document).ready(function() {
        $('.carousel').carousel({
            interval: false
        });
    });
</script>

<script>
    function openCity(evt, cityName)
    {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++)
        {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++)
        {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Simulate a click on the "Videos" button when the page loads
    document.addEventListener("DOMContentLoaded", function ()
    {
        document.querySelector(".tablinks:first-child").click();
    });
</script> 


@endsection