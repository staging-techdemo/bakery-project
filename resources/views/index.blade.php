@extends('layouts.main')
@section('content')
    <!-- Banner Section Start -->




    <section class="hero-sec">
        <div class="banner-image">
            @foreach ($sliders as $slider)
                <img src="{{ asset($slider->img_path) }}" alt="">

        </div>
        <div class="hero-hd home-hero" data-aos="flip-right">
            <h1>{{ $slider->headings }}</h1>
        </div>
        @endforeach
    </section>





    <!-- Banner Section End -->






    <!-- tabs section start -->

    <div class="section-tabs">
        <h2 class="tab-hed" data-aos="fade-up">Our Products</h2>
        <div class="container">
            <div class="main">
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'All products')" data-route="{{route('products')}}">All products /</button>
                    @foreach ($categories as $category)
                        <button type="button" class="tablinks" onclick="openCity(event, 'American')"
                            data-route="{{ route('products', $category->slug) }}">
                            {{ $category->title }}
                        </button>
                    @endforeach
                </div>


                <div id="All products" class="tabcontent" style="display: block;">
                    <div class="row" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        @foreach ($products as $product)
                            @if ($product->is_featured)
                                <div class="col-md-3">
                                    <a href="{{ route('product-detail', $product->slug) }}">
                                        <div class="img-cvr"><img src="{{ asset($product->img_path) }}" alt="">
                                        </div>
                                        <h5>{{ $product->title }}</h5>
                                        <div class="prd-cont">
                                            <img src="{{ asset('assets/images/start-rating.png') }}" alt="">
                                            <span>${{ $product->price }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            @if ($loop->iteration == 4)
                                <!-- Break the loop after the fourth iteration -->
                            @break
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- tabs section end  -->



<!-- section about start  -->

<div class="section-about">
    <?php App\Helpers\Helper::inlineEditable(
        'h2',
        ['class' => ''],
        '
        About Us
                                                ',
        'IN1',
    ); ?>

    {{-- <h2>About Us</h2> --}}
    <?php App\Helpers\Helper::inlineEditable(
        'p',
        ['class' => ''],
        '
        Lorem ipsum is placeholder text commonly
                                                ',
        'IN2',
    ); ?>
    {{-- <p>Lorem ipsum is placeholder text commonly</p> --}}
    <div class="container">
        <div class="row">
            <div class="col-md-6" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                <div class="img-cont">
                    <img src="{{ asset('assets/images/Abt-img.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-6 shadow-col" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
                <div class="abt-content">
                    <?php App\Helpers\Helper::inlineEditable(
                        'h3',
                        ['class' => ''],
                        '
                        Lorem Ipsum is simply dummy text of the printing and typesetting
                                                                ',
                        'IN3',
                    ); ?>
                    {{-- <h3>Lorem Ipsum is simply dummy text of the printing and typesetting</h3> --}}

                    <?php App\Helpers\Helper::inlineEditable(
                        'p',
                        ['class' => ''],
                        "
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown
                                                                ",
                        'IN4',
                    ); ?>
                    {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown.</p> --}}
                    <div class="web-btn">
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- section about close  -->


<!-- section hot and deals start  -->
<div class="section-deal">
    <?php App\Helpers\Helper::inlineEditable(
                        'h2',
                        ['class' => ''],
                        "
                        Hot Deals
                                                                ",
                        'IN5',
                    ); ?>
    {{-- <h2>Hot Deals</h2> --}}
    <?php App\Helpers\Helper::inlineEditable(
                        'p',
                        ['class' => ''],
                        "
                        Lorem ipsum is placeholder text commonly
                                                                ",
                        'IN6',
                    ); ?>
    {{-- <p>Lorem ipsum is placeholder text commonly</p> --}}
    <div class="container">
        <div class="row main-row">
            @php $productIndex = 1; @endphp <!-- Initialize the product index -->
            @foreach ($products as $product)
                @if ($productIndex < 2) <!-- Check if we've shown two products already -->
                    <div class="col-md-6" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                        <a href="{{ route('product-detail', $product->slug) }}">
                            <div class="products-img">
                                <img src="{{ asset($product->img_path) }}" alt="">
                                <h3>{{$product->title}}</h3>
                            </div>
                            <div class="detail">
                                <img class="review-img" src="{{ asset('assets/images/start-rating.png') }}" alt="">
                                <span>${{$product->price}}</span>
                            </div>
                        </a>
                    </div>
                @else <!-- If we've shown two products, show the remaining products in the specified layout -->
                    <div class="col-md-6">
                        <div class="row first-row" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                            @for ($i = 0; $i < 2 && isset($products[$productIndex + $i]); $i++)
                                <div class="col-md-6">
                                    @php $remainingProduct = $products[$productIndex + $i]; @endphp
                                    <a href="{{ route('product-detail', $product->slug) }}">
                                        <div class="product-img">
                                            <img src="{{ asset($remainingProduct->img_path) }}" alt="">
                                            <h3>{{ $remainingProduct->title }}</h3>
                                        </div>
                                        <div class="detail">
                                            <img class="review-img" src="{{ asset('assets/images/start-rating.png') }}" alt="">
                                            <span>${{ $remainingProduct->price }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endfor
                        </div>
                        @php $productIndex += 3; @endphp <!-- Increment product index by 2 to skip the already displayed products -->
                    </div>
                @endif
                @php $productIndex++; @endphp <!-- Increment product index for each iteration -->
            @endforeach
        </div>
    </div>
</div>

<!-- section hot and deals Close  -->


<!-- Video section start  -->
<div class="section-video">
    <img src="{{ asset('assets/images/bask-banner.png') }}" alt="">
    <div class="play-btn">
        <a href="https://youtu.be/D0UnqGm_miA" data-fancybox="gallery"><i class="fa fa-play" aria-hidden="true"></i></a>
    </div>
</div>






<div class="section-why">
    <h2 data-aos="flip-down">Why Choose Our Favorite Food</h2>
    <?php App\Helpers\Helper::inlineEditable(
                        'p',
                        ['class' => ''],
                        "
                        Lorem ipsum is placeholder text commonly
                                                                ",
                        'IN7',
                    ); ?>
    {{-- <p>Lorem ipsum is placeholder text commonly</p> --}}
    <div class="container">
        <div class="row">

            <div class="col-md-4" data-aos="zoom-out-left">
                <div class="box-cont">
                    <img src="{{ asset('assets/images/icon-fst.png') }}" alt="">
                    <?php App\Helpers\Helper::inlineEditable(
                        'h4',
                        ['class' => ''],
                        "
                        Quality full Food
                                                                ",
                        'IN8',
                    ); ?>
                    {{-- <h4>Quality full Food</h4> --}}
                    <?php App\Helpers\Helper::inlineEditable(
                        'p',
                        ['class' => ''],
                        "
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been
                        the industry's
                                                                ",
                        'IN9',
                    ); ?>
                    {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been
                        the industry's</p> --}}
                </div>
            </div>


            <div class="col-md-4" data-aos="zoom-out-down">
                <div class="box-cont">
                    <img src="{{ asset('assets/images/icon-health.png') }}" alt="">
                    <?php App\Helpers\Helper::inlineEditable(
                        'h4',
                        ['class' => ''],
                        "
                        Healthy Food
                                                                ",
                        'IN10',
                    ); ?>
                    {{-- <h4>Healthy Food</h4> --}}
                    <?php App\Helpers\Helper::inlineEditable(
                        'p',
                        ['class' => ''],
                        "
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been
                        the industry's
                                                                ",
                        'IN11',
                    ); ?>
                    {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been 
                        the industry's</p>--}}
                </div>
            </div>



            <div class="col-md-4" data-aos="zoom-out-right">
                <div class="box-cont">
                    <img src="{{ asset('assets/images/icon-qult.png') }}" alt="">
                    <?php App\Helpers\Helper::inlineEditable(
                        'h4',
                        ['class' => ''],
                        "
                        Fast Delivery
                                                                ",
                        'IN12',
                    ); ?>
                    {{-- <h4>Fast Delivery</h4> --}}
                    <?php App\Helpers\Helper::inlineEditable(
                        'p',
                        ['class' => ''],
                        "
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been
                        the industry's
                                                                ",
                        'IN13',
                    ); ?>
                    {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been
                        the industry's</p> --}}
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
<script>
    // Function to handle click event
    function openCity(event, cityName) {
        var route = event.target.getAttribute('data-route'); // Accessing the route
        // Redirect to the route
        window.location.href = route;
    }
</script>
<script type="text/javascript">
    (() => {
        /*in page js here*/
    })()
</script>
@endsection
