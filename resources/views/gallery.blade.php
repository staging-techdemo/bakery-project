@extends('layouts.main')
@section('content')
    <section class="inner_banner">
        <div class="inner_banner_image">
            <img src="{{ asset('assets/images/inner_banner_image.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
                    <h3 class="inner_banner_title">Gallery</h3>
                </div>
                <div class="col-md-6">
                    <div class="inner_banner_image1">
                        @foreach ($sliders as $slider)
                                                 
                        <img src= {{ asset($slider->img_path) }} alt="">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="gallery">



        <div class="container">
            <div class="gallery_main">

                <div class="row">
                    @foreach ($galleries as $key => $gallery)
                        @php
                            $columns = [5, 7, 4, 4, 4, 3, 4, 5];
                            $columnClass = $columns[$key % count($columns)];
                        @endphp
                        <div class="col-md-{{ $columnClass }}">

                            <div class="main__gallary">
                                <div class="gallaery_image">
                                    <img src="{{ asset($gallery->img_path) }}" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach

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
