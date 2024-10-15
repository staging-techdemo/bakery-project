@extends('layouts.main')
@section('content')

<section class="inner_banner">
    <div class="inner_banner_image">
        <img src="assets/images/inner_banner_image.png" alt="">
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
                <h3 class="inner_banner_title">News</h3>
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

<section class="news">

    <div class="contest_back_image">
        <img src="assets/images/about-----back.jpg" alt="">
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="news_card">
                    <div class="news_card_image">
                        <img src="assets/images/footer_logo.png" alt="">
                    </div>
                    <div class="news_icon_image">
                        <img src="assets/images/news_icon_image.png" alt="">
                    </div>
                    <div class="news_card_btn">
                        <a href="{{route('login')}}">Login To View Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


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
