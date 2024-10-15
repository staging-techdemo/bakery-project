@extends('layouts.main')
@section('content')
    <!-- Banner Section Start -->




    <section class="hero-sec">
        <div class="banner-image">
            <img src="{{ asset('assets/images/contact/contact-banner.png') }}" alt="">
        </div>
        <div class="hero-hd">
            <h1>Contact Us</h1>
        </div>
    </section>





    <!-- Banner Section End -->


    <!-- Contact Section Start -->

    <section class="contact-form-sec">
        <div class="container">
            <div class="cnt-form">
                <form action="{{ route('new-contact-us-submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input id="01" type="text" placeholder="Your Name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input id="01" type="text" placeholder="Your Last Name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <input id="02" type="email" placeholder="Email Address" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Enter Your Phone Number" name="phone"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <textarea id="03" cols="30" rows="5" placeholder="Your Message to Us" name="message"></textarea>
                            @error('message')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>
                    <div class="submt-blk">
                        <input type="submit" value="Submit">
                    </div>


                </form>
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
