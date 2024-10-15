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
                    <h3>HELPFUL LINKS</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="helpful">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="qoute_request_heading">Helpful Links</h3>
            </div>
            <div class="col-md-3">
                <ul class="help_links">
                    <li><a href="#">1. www.google.com</a></li>
                    <li><a href="#">2. www.rent.com</a></li>
                    <li><a href="#">3. www.weather.com</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="helpful">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="qoute_request_heading">Partners Links</h3>
            </div>
            <div class="col-md-3">
                <ul class="help_links">
                    <li><a href="#">1. www.google.com</a></li>
                    <li><a href="#">2. www.weddinganswers.com</a></li>
                    <li><a href="#">3. www.decidio.com</a></li>
                    <li><a href="#">4. www.youtu.be/c5BnyCIa1z0</a></li>
                </ul>
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