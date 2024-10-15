@extends('layouts.main')
@section('content')
<section class="hero-sec">
    <div class="banner-image">
        <img src="{{ asset('assets/images/contact/contact-banner.png') }}" alt="">
    </div>
    <div class="hero-hd">
        <h1>signup</h1>
    </div>
</section>
    <section class="login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="login__box" id="sign">
                        <div class="section_content">
                            <h3 class="heading text-center">Sign Up</h3>
                        </div>
                        <form action="{{ route('sign-up-submit') }}" method="POST" class="login__form">
                            @csrf
                            <div class="sign_feild">
                                <label for="name">Name</label>
                                <input type="text" placeholder="Bake YAYA" id="name" name="full_name"
                                    value="{{ old('full_name') }}">
                                @error('full_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sign_feild">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Bake YAYA@gmail.com"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sign_feild">
                                <label for="pass">Password</label>
                                <input type="password" name="sign_up_password" id="pass" placeholder="**************">
                                @error('sign_up_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="log__btn">
                                <button type="submit" class="btn">Sign Up</button>
                            </div>
                            <div class="forget">Already have an account? <a href="{{route('login')}}">Login</a></div>
                            
                        </form>
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
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#full_name').on('input', function(e) {
                $.get('{{ route('check_slug') }}', {
                        'title': $(this).val()
                    },
                    function(data) {
                        $('#slug').val(data.slug);
                    }
                );
            });
        });

    </script> --}}
@endsection
