@extends('layouts.main')
@section('content')

<!-- Banner Section Start -->




<section class="hero-sec">
    <div class="banner-image">
      <img src="{{asset('assets/images/blog/blog-detail-banner.png')}}" alt="">
    </div>
    <div class="hero-hd">
        <h1>Blog Details</h1>
        </div>
</section>





<!-- Banner Section End -->





<!-- Blogs Grid Section Start -->



<section class="blog-dtl-section">
  <div class="container">
    <div class="row">

      <div class="col-md-5">
        <div class="blog-main-image">
          <img src="{{asset($blog->img_path)}}" alt="">
        </div>
      </div>

      <div class="col-md-7">
        <div class="blog-dtl-cont">
          <div class="blg-hd">
            <h2>{{ $blog->title }}</h2>
          </div>
          <div class="post-names">
              <p class="blg-date">{{ $blog->created_at }}</p>
              <p class="blg-publisher">{{ $blog->topic }}</p>
            </div>
            <p class="detail-exerpt">{{ $blog->short_desc }}</p>
        </div>
      </div>
    </div>

    <div class="xtra-blg-cont">
      <p class="detail-exerpt">{!! $blog->long_desc !!}</p>
    </div>

  </div>
</section>




<!-- Blogs Grid Section End -->










<script>
    AOS.init({
      duration: 1000
    });
    </script>
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