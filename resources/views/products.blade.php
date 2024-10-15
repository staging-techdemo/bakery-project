@extends('layouts.main')
@section('content')
    <section class="hero-sec">
        <div class="banner-image">
            <img src="{{ asset('assets/images/bask-banner.png') }}" alt="">
        </div>
        <div class="hero-hd home-hero">
            <h1>Shop</h1>
        </div>
    </section>





    <!-- Banner Section End -->




    <!-- tabs section start -->

    <div class="section-tabs prd-pg">
        <h2 class="tab-hed" data-aos="fade-up">Our Products</h2>
        <div class="container">
            <div class="main">
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'All products')"
                        data-route="{{ route('products') }}">All products /</button>
                    @foreach ($categories as $category)
                        <button type="button" class="tablinks" onclick="openCity(event, 'American')"
                            data-route="{{ route('products', $category->slug) }}">
                            {{ $category->title }}
                        </button>
                    @endforeach
                </div>


                <div id="All products" class="tabcontent" style="display: block;">


                    <div class="row" data-aos="fade-up">
                        @foreach ($products as $index => $product)
                        @if ($index % 4 == 0)
                        </div><div class="row" data-aos="fade-up"> <!-- Close and open a new row after every third blog -->
                    @endif
                            <div class="col-md-3">
                                <a href="{{ route('product-detail', $product->slug) }}">
                                    <div class="img-cvr">
                                    <img src="{{ asset($product->img_path) }}" alt="">
                                    </div>
                                    <h5>{{ $product->title }}</h5>
                                    <div class="prd-cont">
                                        <img src="{{ asset('assets/images/start-rating.png') }}" alt="">
                                        <span>${{ $product->price }}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- tabs section end  -->
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var categoryRadios = document.getElementsByName('category');

            categoryRadios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    window.location.href = this.nextElementSibling.querySelector('a').href;
                });
            });
        });
    </script>
    <script>
        $(".whishbtn").click(function(e) {

            @if (Auth::check())

                var productid = $(this).data("id");
                // console.log(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({


                    type: "post",

                    url: "{{ route('add.to.wishlist') }}",

                    data: {
                        productid: productid
                    },
                    dataType: "json",


                    success: function(msg) {

                        if (msg.status == 1) {


                            $.toast({
                                heading: 'Success!',
                                position: 'bottom-right',
                                text: "Product Added to Wishlist",
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 2000,
                                stack: 6
                            });
                            setInterval(() => {

                                location.reload();
                            }, 2050);
                        }

                        if (msg.status == 2) {


                            $.toast({
                                heading: 'Success!',
                                position: 'bottom-right',
                                text: msg.msg,
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 2000,
                                stack: 6
                            });
                            setInterval(() => {

                                location.reload();
                            }, 2050);



                        }


                    },
                    beforeSend: function() {

                    }
                });
            @else

                console.log("sss");

                $.toast({
                    heading: 'error!',
                    position: 'top-right',
                    text: "You need to login first!",
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 2500,
                    stack: 6
                });


                setInterval(() => {

                    window.location = "{{ route('login') }}";
                }, 1000);
            @endif



        });
    </script>
    <script type="text/javascript">
        (() => {
            /*in page js here*/
        })()
    </script>
@endsection
