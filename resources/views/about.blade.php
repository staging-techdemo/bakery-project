@extends('layouts.main')
@section('content')

    


<!-- Banner Section Start -->




<section class="hero-sec">
    <div class="banner-image">
      <img src="{{asset('assets/images/about/about-banner.png')}}" alt="">
    </div>
    <div class="hero-hd">
        <h1>About</h1>
        </div>
</section>





<!-- Banner Section End -->







<!-- section about start  -->

<div class="section-about about-pg-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-6" data-aos="fade-right"
     data-aos-offset="300"
     data-aos-easing="ease-in-sine">
        <div class="img-cont">
          <img src="{{asset('assets/images/about/about.png')}}" alt="">
        </div>
      </div>
      <div class="col-md-6 shadow-col" data-aos="fade-left"
     data-aos-offset="300"
     data-aos-easing="ease-in-sine">
        <div class="abt-content">
          <?php App\Helpers\Helper::inlineEditable(
                        'h3',
                        ['class' => ''],
                        "
                        Lorem Ipsum is simply dummy text of the printing and typesetting
                                                                ",
                        'AB1',
                    ); ?>
          {{-- <h3>Lorem Ipsum is simply dummy text of the printing and typesetting</h3> --}}
          <?php App\Helpers\Helper::inlineEditable(
                        'p',
                        ['class' => ''],
                        "
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown.
                                                                ",
                        'AB2',
                    ); ?>
          {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown.</p> --}}
          <?php App\Helpers\Helper::inlineEditable(
                        'p',
                        ['class' => ''],
                        "
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                                                ",
                        'AB2',
                    ); ?>
          {{-- <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset</p> --}}
        </div>
      </div>
    </div>
  </div>
</div>

<!-- section about close  -->








<!-- Video section start  -->




<div class="section-video">
    <img src="{{asset('assets/images/bask-banner.png')}}" alt="">
<div class="play-btn">
  <a href="https://youtu.be/D0UnqGm_miA" data-fancybox="gallery"><i class="fa fa-play" aria-hidden="true"></i></a>
</div>
</div>





<!-- Video section End  -->






<div class="section-why">
<h2 data-aos="flip-down">Why Choose Our Favorite Food</h2>
  <p>Lorem ipsum is placeholder text commonly</p>
<div class="container">
	<div class="row">

	<div class="col-md-4" data-aos="zoom-out-left">
		<div class="box-cont">
			<img src="{{asset('assets/images/icon-fst.png')}}" alt="">
			<h4>Quality full Food</h4>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's</p>
		</div>
	</div>

	
	<div class="col-md-4" data-aos="zoom-out-down">
		<div class="box-cont">
			<img src="{{asset('assets/images/icon-health.png')}}" alt="">
			<h4>Healthy Food</h4>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's</p>
		</div>
	</div>


	
	<div class="col-md-4" data-aos="zoom-out-right">
		<div class="box-cont">
			<img src="{{asset('assets/images/icon-qult.png')}}" alt="">
			<h4>Fast Delivery</h4>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's</p>
		</div>
	</div>
	

</div>
</div>
</div>



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