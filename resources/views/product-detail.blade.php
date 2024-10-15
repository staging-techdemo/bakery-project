@extends('layouts.main')
@section('content')
    <!-- Banner Section Start -->




    <section class="hero-sec">
        <div class="banner-image">
            <img src="{{ asset('assets/images/bask-banner.png') }}" alt="">
        </div>
        <div class="hero-hd home-hero">
            <h1>Shop</h1>
        </div>
    </section>





    <!-- Banner Section End -->





    <!-- Product detail Section Start -->




    <section class="prd-dtl-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                  <div class="product-image-blk">
                        <img src={{ asset($product->img_path) }} alt="">
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="prd-dtl-blk">
                        <h2>{{ $product->title }}</h2>
                        <ul class="rating-list">
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="rev-list">4.9 Review</li>
                        </ul>
                        <h3>${{ $product->price }}</h3>
                        <p class="prd-desc">{!! $product->long_desc !!}</p>
                        <div class="quantity-blk">
                            <h4>Buy More Save More:</h4>
                        </div>

                        <div class="ad-crt-cta">
                            <form action="{{ route('save-cart') }}" method="POST">
                                @csrf
                                <div class="qty-input">
                                    <button onclick="incrementCount('count1')" class="plus" type="button"><i
                                            class='bx bx-chevron-up'></i>+</button>
                                    <input class="product-qty" type="text" name="qty" id="count1" min="0"
                                        max="10" value="01">
                                    <button onclick="decrementCount('count1')" class="minus" type="button"><i
                                            class='bx bx-chevron-down'></i>-</button>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" id="cart-price" name="price" value="{{ $product->price }}">
                                <button type="submit" class="add-to-cart">Add To cart</a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <div class="related-prd-sec">
                <h2>Related products</h2>

                <div class="row">
                    @foreach ($products as $product)
                        @if ($product->is_featured)
                            <div class="col-md-3">
                                <img src="{{ asset($product->img_path) }}" alt="">
                                <h5>{{ $product->title }}</h5>
                                <div class="prd-cont">
                                    <img src="{{ asset('assets/images/start-rating.png') }}" alt="">
                                    <span>${{ $product->price }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
    </section>




    <!-- Product detail Section End -->







    <script>
        AOS.init({
            duration: 1000
        });
    </script>
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
    <script>
        function incrementCount(inputId) {
            var inputElement = document.getElementById(inputId);
            var value = parseInt(inputElement.value);
            if (value < parseInt(inputElement.getAttribute('max'))) {
                inputElement.value = value + 1;
            }
        }

        function decrementCount(inputId) {
            var inputElement = document.getElementById(inputId);
            var value = parseInt(inputElement.value);
            if (value > parseInt(inputElement.getAttribute('min'))) {
                inputElement.value = value - 1;
            }
        }
    </script>
@endsection
