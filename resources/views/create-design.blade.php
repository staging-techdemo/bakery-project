@extends('layouts.main')
@section('content')

<section class="inner_banner">
    <div class="inner_banner_image">
        <img src="{{asset('assets/images/inner_banner_image.png')}}" alt="">
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
                <h3 class="inner_banner_title">Create Design</h3>
            </div>
            <div class="col-md-6">
                <div class="inner_banner_image1">
                    @foreach ($sliders as $slider)
                        
                   
                    <img src="{{asset($slider->img_path)}}" alt="">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<section class="news_subscribe">

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8" data-aos="zoom-in-up" data-aos-duration="2000">
                <div class="news_subscribe_content text-center">

                    <h5 class="ns_subtitle">Become A Participant</h5>
                    <form action="{{ route('participant_submit') }}" class="news_subscribe_form w-100" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="contest_id" value="{{$contest->id}}">
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="text" name="name" placeholder="Enter Name:" class="form-control">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        {{-- <input type="file" name="img_path" accept="image/jpeg, image/png" class="form-control">
                        @error('img_path')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror --}}

                        <button class="themebtn">Submit Now!</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>


{{-- 
<section class="create_design">

    <div class="contest_back_image">
        <img src="{{asset('assets/images/about-----back.jpg')}}" alt="">
    </div> --}}


    {{-- <div class="container">
        <div class="create_design_image">
            <img src="{{asset('assets/images/create-design_image.png')}}" alt="">
        </div>
    </div> --}}

{{-- </section> --}}




<!-- Footer -->
@endsection
@section('css')
<style type="text/css">
/*in page css here*/
</style>
@endsection
@section('js')
<script type="text/javascript">
    (() => {
        /*in page js here*/
    })()
</script>
@endsection
