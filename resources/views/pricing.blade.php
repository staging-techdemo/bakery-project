@extends('layouts.main')
@section('content')
<section class="main-banner" style="background-image: url(assets/images/main-banner.png);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="banner-con">
                    <h3>Pricing
                    </h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="banner-item">
                    <img src="{{ asset("assets/images/inner-banner-6.png") }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pricing">
    <div class="container">
        <div class="title text-center pb-5">
            
    <?php App\Helpers\Helper::inlineEditable(
        'h3',
        ['class' => ''],
        '
                                Pricing plans that suit you
                                            ',
        'PRICINGTXT2',
    ); ?>

            
    <?php App\Helpers\Helper::inlineEditable(
        'p',
        ['class' => ''],
        '
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
                                            ',
        'PRICINGTXT3',
    ); ?>

        </div>
        <div class="pricing-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active subs-type" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true" data-pay-type="month">Monthly</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link subs-type" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false" data-pay-type="year">Yearly</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <section class="pricing-plan">
                        <div class="container">
                            <div class="row">
                                @foreach($monthly_packages as $i => $package)
                                @php
                                $i++; 
                                $perks = $package->get_package_perks;
                                @endphp
                                <div class="col-md-4">
                                    <div class="pricing-plan-item">
                                        <div class="reguler">
                                            <a href="">{{$i++}}</a>
                                            <div class="plan">
                                                <h5>{{ $package->title }} </h5>
                                                <p>{{ $package->sub_title }}</p>
                                            </div>
                                        </div>
                                        <ul>
                                            @foreach($perks as $perk)
                                            <li><a href="">{{ $perk->perk }}</a></li>
                                            @endforeach()
                                        </ul>
                                        <div class="plan-footer">
                                            <p>{{ $package->short_desc }}</p>
                                            <h4>${{ $package->price }} </h4>
                                            <p>{{ $package->is_limited == 1 ? 'For Limited Period' : '' }}</p>
                                            <div class="plan-btn">
                                                <a href="javascript:void(0);" class="open-custom-form get-subscription"  data-price="{{ $package->price }}" data-pkg-id="{{ $package->id }}">Get started</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <section class="pricing-plan">
                        <div class="container">
                            <div class="row">
                                 @foreach($year_packages as $i => $package)
                                @php
                                $i++; 
                                $perks = $package->get_package_perks;
                                @endphp
                                <div class="col-md-4">
                                    <div class="pricing-plan-item">
                                        <div class="reguler">
                                            <a href="">{{$i++}}</a>
                                            <div class="plan">
                                                <h5>{{ $package->title }} </h5>
                                                <p>{{ $package->sub_title }}</p>
                                            </div>
                                        </div>
                                        <ul>
                                            @foreach($perks as $perk)
                                            <li><a href="">{{ $perk->perk }}</a></li>
                                            @endforeach()
                                        </ul>
                                        <div class="plan-footer">
                                            <p>{{ $package->short_desc }}</p>
                                            <h4>${{ $package->price }} </h4>
                                            <p>{{ $package->is_limited == 1 ? 'For Limited Period' : '' }}</p>
                                            <div class="plan-btn">
                                                <a href="javascript:void(0);" class="open-custom-form get-subscription"  data-price="{{ $package->price }}" data-pkg-id="{{ $package->id }}">Get started</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>





@include('layouts.testimonials')


@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        (() => {
            $(document).ready(function () {
  $("#pay_type").val("month");
  $(".subs-type").click(function () {
    var subs_type = $(this).data("pay-type");
    $("#pay_type").val(subs_type);
  });
  $(".get-subscription").click(function () {
    var price = $(this).data("price");
    var pkg_id = $(this).data("pkg-id");
    $("#pkg_id").val(pkg_id)
    $("#amount").val(price)
  });
});

        })()
    </script>
@endsection