@extends('layouts.main')
@section('content')
    <section class='banner_inner'>
        <div class='banner__img Innerbanner__img'>
            @foreach ($sliders as $slider)
                <img src="{{ $slider->img_path ? asset($slider->img_path) : '//..assets/images/inner7.png' }}" alt=''
                    class='img__cover'>
            @endforeach
        </div>
        <div class='container'>
            <div class='row'>
                <div class='col-lg col-md col-sm'>
                    <div class='Innerbanner__con'>
                        <h3>{{ $slider->headings }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="inner__products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sectionContent text-center">
                        @if (!empty($products) && (is_array($products) ? !empty($products) : !$products->isEmpty()))
                            <?php App\Helpers\Helper::inlineEditable(
                                'h3',
                                ['class' => 'heading'],
                                'Best Sale Products',
                                'CAR1',
                            ); ?>
                        @else
                            <div class="sectionContent text-center">
                                <h3 class="heading">
                                    No Products Available
                                </h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="inner__productsMain">
                <div class="row">
                    <div class="col-md-3">
                        <div class="pro__cataList">
                            <div class="cata__head">
                                Category
                            </div>
                            <ul class="cata__list cata__list--alt">
                                <li><a href="{{ route('products') }}">All</a></li>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('products', $category->slug) }}">
                                            {{ $category->title }}
                                            {{-- Check if the category has subcategories --}}
                                            @if($subcats->where('category_id', $category->id)->count() > 0)
                                                <i class='bx bx-chevron-down'></i>
                                            @endif
                                        </a>
                            
                                        {{-- Display subcategories if they exist --}}
                                        @if($subcats->where('category_id', $category->id)->count() > 0)
                                        <ul class="subCata">
                                            @foreach($subcats->where('category_id', $category->id) as $subcategory)
                                                <li><a href="{{ route('products', [$category->slug, $subcategory->slug]) }}">{{ $subcategory->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                            </ul>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="products__Main">
                            @if (!empty($products) && (is_array($products) ? !empty($products) : !$products->isEmpty()))
                            <div class="row">
                                @foreach ($products as $product)
                                        <div class="col-md-4">
                                            <div class="pro__Crd">
                                                <a href="{{ route('product-detail', $product->slug) }}" class="pro__img">
                                                    <img src="{{ asset($product->img_path) }}" alt='' class='img__cover'>
                                                </a>
                                                <div class="pro__con">
                                                    <a href="{{ route('product-detail', $product->slug) }}" class="pro__head">{{ $product->title }}</a>
                                                    <div class="price__rate">
                                                        <div class="price">
                                                            <p>${{ $product->price }} <del>${{ $product->old_price }}</del></p>
                                                        </div>
                                                        <ul class="ratting">
                                                            <li><i class='bx bxs-star'></i></li>
                                                            <li><i class='bx bxs-star'></i></li>
                                                            <li><i class='bx bxs-star'></i></li>
                                                            <li><i class='bx bxs-star'></i></li>
                                                            <li><i class='bx bxs-star'></i></li>
                                                        </ul>
                                                    </div>
                                                    <div class="shop__btn">
                                                        <a href="{{ route('product-detail', $product->slug) }}">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
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
