@extends('layouts.main')
@section('content')
<section class="inner_banner">
    <div class="inner_bg">
        <img src="{{asset('assets/images/inner_banner.png')}}" alt='' class='img__cover'>
    </div>
    <div class="inner_img inner_img--alt"><img src="{{asset('assets/images/inner_banner/6.png')}}" alt='' class='img__contain'></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="inner_bannerCon">
                    <h3>Recovery</h3>
                </div>
            </div>
        </div>
    </div>
</section>


   <section class="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login__box">
                    <div class="section_content">
                            <h3 class="heading text-center"> Forget Password</h3>
                        </div>
                        <form method="POST" action="{{ route('forget_password_submit') }}" class="login__form">
                            @csrf
                            
                            
                              <div class="login_feild">
                                <input type="email" id="email" name="email" placeholder="Enter Your Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="log__btn">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                        </form>
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
