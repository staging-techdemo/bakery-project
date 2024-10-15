@extends('layouts.main')
@section('content')
<section class='banner_inner'>
    <div class='banner__img Innerbanner__img'>
        <img src="{{asset('assets/images/inner12.png')}}" alt='' class='img__cover'>
    </div>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12 col-md-12 col-sm-12'>
                <div class='Innerbanner__con'>
                    <h3>
FAQ
</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="faqs">
    <div class="container">
        <div class="faq__main">
            <div id="accordion">
                @foreach ($faqs as $index => $faq)
                    <div class="card">
                        <div class="card-header" id="heading{{ $index }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}">
                                    {{ $faq->question }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-parent="#accordion">
                            <div class="card-body">{!! $faq->answer !!}</div>
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