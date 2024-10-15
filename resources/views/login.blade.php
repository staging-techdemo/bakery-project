@extends('layouts.main')
@section('content')
    <!-- Banner Section Start -->




    <section class="hero-sec">
        <div class="banner-image">
            <img src="{{ asset('assets/images/contact/contact-banner.png') }}" alt="">
        </div>
        <div class="hero-hd">
            <h1>Login</h1>
        </div>
    </section>





    <!-- Banner Section End -->


    <!-- Contact Section Start -->

    <section class="login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login__box">
                        <div class="section_content">
                            <h3 class="heading text-center">Log In</h3>
                        </div>
                        <form action="{{route('login-submit')}}" class="login__form" method="POST">
                            @csrf
                            <div class="login_feild">
                                <input type="email" name="login_email" placeholder="Email" value="{{old('login_email')}}">
                                @error('login_email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="login_feild">
                                <input type="password" name="login_password" placeholder="*************">
                                @error('login_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="log__btn">
                                <button type="submit" class="btn">Log In</button>
                            </div>
                            <div class="forget">Don’t have an account? <a href="{{route('signup')}}">Sign Up</a></div>
                            <div class="forget">Forgot Password? <a href="{{route('forget-password')}}">Click Here</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section End -->

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
