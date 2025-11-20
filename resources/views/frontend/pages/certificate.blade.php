@extends('layouts/frontend/main')
@section('meta-title', 'स्वास्थ्य और खुशहाली | Health and Wellness - भारतीय परम्परा')
@section('meta-description', 'स्वास्थ्य और खुशहाली, healthy food, Health and Wellness, ayurveda, yoga, aasana, pranayam')
@section('main-section')

<section class="pdf">
    <div class="container">
        <div class="row my-3">

        @foreach($certificate_list as $certificate)
            <div class="col-md-4 mb-4">
                <iframe id="pdfViewer" src="{{url('public/build/assets/upload/writer/certificate')}}/{{$certificate->certificate}}" width="100%"
                    height="600px"></iframe>
                    <h5>{{$certificate->name}}</h5>
                <div class="pdf-btns">
                    <a href="{{url('public/build/assets/upload/writer/certificate')}}/{{$certificate->certificate}}" target=_blank> <span class="btn btn-sm btn-color">View</span></a>
                    <a href="{{url('public/build/assets/upload/writer/certificate')}}/{{$certificate->certificate}}" download> <span
                            class="btn btn-sm btn-color">Download</span></a>
                </div>
            </div>
            @endforeach
              
        </div>
    </div>
    <div class="my_pagination container mt-5">
{{$certificate_list->links('pagination::bootstrap-5')}}
</div>
</section>



@endsection
