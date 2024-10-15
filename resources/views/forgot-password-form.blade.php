@extends('layouts.main')
@section('content')
    <section class="inner_banner">
        <div class="inner_bg">
            <img src="{{ asset('assets/images/inner_banner.png') }}" alt='' class='img__cover'>
        </div>
        <div class="inner_img inner_img--alt"><img src="{{ asset('assets/images/inner_banner/6.png') }}" alt=''
                class='img__contain'></div>
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


                        <form method="POST" action="{{ route('forget-password-reset') }}" class="login__form">
                            @csrf
                            <input name="email" value="{{ $reset_email->email }}" type="hidden">
                            <input name="token" value="{{ $token }}" type="hidden">


                            <div class="login_feild">
                                <input type="password" placeholder="Enter Your new Password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="log__btn">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                    </div>
                    </form>
                </div>

                <!-- Exist ing Login and Sign Up Forms -->
                <!-- ... existing login and sign up forms ... -->

            </div>
        </div>
    </section>
@endsection
