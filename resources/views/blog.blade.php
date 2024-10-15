@extends('layouts.main')
@section('content')
    <!-- Banner Section Start -->




    <section class="hero-sec">
        <div class="banner-image">
            <img src="{{ asset('assets/images/blog/blog-banner.png') }}" alt="">
        </div>
        <div class="hero-hd">
            <h1>Blog</h1>
        </div>
    </section>





    <!-- Banner Section End -->





    <!-- Blogs Grid Section Start -->



    <section class="blogs-sec">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $index => $blog)
                    @if ($index % 3 == 0)
                        </div><div class="row"> <!-- Close and open a new row after every third blog -->
                    @endif
                    <div class="col-md-4 blog-col">
                        <a href="{{ route('blog-details', ['slug' => $blog->slug]) }}">
                            <div class="blog-card">
                                <div class="blog-image">
                                    <img src="{{ asset($blog->img_path) }}" alt="">
                                </div>
                                <div class="blog-card-content">
                                    <h3>{{ $blog->title }}</h3>
                                    <div class="post-names">
                                        <p class="blg-date">{{ $blog->created_at }}</p>
                                        <p class="blg-publisher">{{ $blog->topic }}</p>
                                    </div>
                                    <p class="blog-excerpt">{{ $blog->short_desc }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    



    <!-- Blogs Grid Section End -->



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
@endsection
