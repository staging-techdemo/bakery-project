@extends('layouts.main')
@section('content')
    <section class='banner_inner'>
        <div class='banner__img Innerbanner__img'>
            @foreach ($sliders as $slider)
                <img src="{{ asset($slider->img_path) }}" alt='' class='img__cover'>
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
    <section class="services">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row justify-content-between">

                        @foreach ($services as $service)
                            <div class="col-md-6 mb-4">
                                <div class="ser__card">
                                    <div class="ser__card__items">

                                        <div class="ser__image">
                                            <a href="{{ route('services-detail', $service->slug) }}">
                                                <img src="{{ asset($service->img_path) }}" alt=''
                                                    class='img__cover'>
                                            </a>
                                        </div>
                                        <div class="ser__cont">
                                            <h3 class="ser__card_title">{{ $service->title }}</h3>
                                            <p class="ser__card_para">{{ $service->short_desc }}</p>
                                        </div>

                                        @if (isset($service->long_desc) && strip_tags($service->long_desc) !== '')
                                            <h5 class="ser__card_subtitle">Here are the services we provide:</h5>
                                            <div class="ser__card_list">
                                                <div class="card_list_item1 col-md-6 mb-4">
                                                    <ul>
                                                        {!! $service->long_desc !!}
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>



    </section>
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
