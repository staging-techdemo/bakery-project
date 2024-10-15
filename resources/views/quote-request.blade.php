@extends('layouts.main')
@section('content')
<section class='banner_inner'>
    <div class='banner__img Innerbanner__img'>
        @foreach ($sliders as $slider)
        <img src="{{asset($slider->img_path)}}" alt='' class='img__cover'>
        @endforeach
    </div>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12 col-md-12 col-sm-12'>
                <div class='Innerbanner__con'>
                    <h3>{{$slider->headings}}</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="qoute_request">

    <div class="container">
        <div class="quote__box">
            <span> </span>
            <span> </span>
            <span> </span>
            <span> </span>
            <h3 class="qoute_request_heading">Quote Request</h3>
            <form action="{{route('quote-submit')}}" class="qoute_form" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label>Full Name <span>*</span></label>
                        <input id="1" type="text" class="form-control" placeholder="Enter" name="name">
                    </div>
                    <div class="col-md-4">
                        <label>Company Name<span>*</span></label>
                        <input id="2" type="text" class="form-control" placeholder="Enter" name="company_name">
                    </div>
                    <div class="col-md-4">
                        <label>Address<span>*</span></label>
                        <input id="3" type="text" class="form-control" placeholder="Enter" name="address">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Address 2<span>*</span></label>
                        <input id="4" type="text" class="form-control" placeholder="Enter" name="other_address">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>City<span>*</span></label>
                        <input id="5" type="text" class="form-control" placeholder="Enter" name="city">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>State<span>*</span></label>
                        <input id="6" type="text" class="form-control" placeholder="Enter" name="state">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Zip Code<span>*</span></label>
                        <input id="7" type="text" class="form-control" placeholder="Enter" name="zip">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>E-Mail Address<span>*</span></label>
                        <input id="8" type="email" class="form-control" placeholder="Enter" name="email">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Home Phone<span>*</span></label>
                        <input id="9" type="text" class="form-control" placeholder="Enter" name="h_phone">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Cell Phone<span>*</span></label>
                        <input id="10" type="text" class="form-control" placeholder="Enter" name="phone">
                    </div>
                    <div class="col-md-4 mt-5">
                        <h6 class="checkbox_title">How would you prefer to be contacted?</h6>
                        <div class="checkbox">
                            <div class="check">
                                <input id="11" type="radio" id="1" value="1" name="contact_method">
                                <label>Phone</label><br>
                            </div>
                            <div class="check">
                                <input id="12" type="radio" id="2"  value="2" name="contact_method">
                                <label>Email</label><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Date of Event<span>*</span></label>
                        <input id="13" type="text" class="form-control" placeholder="Enter" name="e_date">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Event Location<span>*</span></label>
                        <input id="14" type="text" class="form-control" placeholder="Enter" name="e_location">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>How did you hear about us?<span>*</span></label>
                        <input id="15" type="text" class="form-control" placeholder="Enter" name="about_us">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Event You're Planning<span>*</span></label>
                        <input id="16" type="text" class="form-control" placeholder="Enter" name="e_planning">
                    </div>
                    <div class="col-md-4 mt-5">
                        <div class="input__feild">
                            <label>Number Attending?<span>*</span></label>
                            <input id="17 " type="text" class="form-control" placeholder="Enter" name="persons">
                        </div>
                        <div class="input__feild mt-5">
                            <label>Delivery Day<span>*</span></label>
                            <select name="d_date">
                                <option value="">Please select</option>
                                <option value="1-2 Business Days Prior" data-index="0">1-2 Business Days Prior</option>
                                <option value="1 Business Day Prior" data-index="1">1 Business Day Prior</option>
                                <option value="Same Day (Monday-Friday)" data-index="2">Same Day (Monday-Friday)</option>
                                <option value="Saturday (Additional fee applies)" data-index="3">Saturday (Additional fee applies)</option>
                                <option value="Sunday (Additional fee applies)" data-index="4">Sunday (Additional fee applies)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 mt-5">
                        <label>Details about the event and your comments<span>*</span></label>
                        <textarea name="message" id="18" cols="30" rows="10" class="form-co1ntrol" placeholder="Additional Details..."></textarea>
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Delivery Time<span>*</span></label>
                        <select name="d_time">
                            <option value="">Please select</option>
                            <option value="8AM-6PM (Standard business hours)" data-index="0">8AM-6PM (Standard business hours)</option>
                            <option value="6AM-7AM (Additional fee would apply)" data-index="1">6AM-7AM (Additional fee would apply)</option>
                            <option value="7AM-8AM (Additional fee would apply)" data-index="2">7AM-8AM (Additional fee would apply)</option>
                            <option value="8AM-9AM (Additional fee would apply)" data-index="3">8AM-9AM (Additional fee would apply)</option>
                            <option value="9AM-10AM (Additional fee would apply)" data-index="4">9AM-10AM (Additional fee would apply)</option>
                            <option value="10AM-11AM (Additional fee would apply)" data-index="5">10AM-11AM (Additional fee would apply)</option>
                            <option value="11AM-12Noon (Additional fee would apply)" data-index="6">11AM-12Noon (Additional fee would apply)</option>
                            <option value="12Noon-1PM (Additional fee would apply)" data-index="7">12Noon-1PM (Additional fee would apply)</option>
                            <option value="1PM-2PM (Additional fee would apply)" data-index="8">1PM-2PM (Additional fee would apply)</option>
                            <option value="2PM-3PM (Additional fee would apply)" data-index="9">2PM-3PM (Additional fee would apply)</option>
                            <option value="3PM-4PM (Additional fee would apply)" data-index="10">3PM-4PM (Additional fee would apply)</option>
                            <option value="4PM-5PM (Additional fee would apply)" data-index="11">4PM-5PM (Additional fee would apply)</option>
                            <option value="5PM-6PM (Additional fee would apply)" data-index="12">5PM-6PM (Additional fee would apply)</option>
                            <option value="6PM-7PM (Additional fee would apply)" data-index="13">6PM-7PM (Additional fee would apply)</option>
                            <option value="7PM-8PM (Additional fee would apply)" data-index="14">7PM-8PM (Additional fee would apply)</option>
                            <option value="8PM-9PM (Additional fee would apply)" data-index="15">8PM-9PM (Additional fee would apply)</option>
                            <option value="9PM-10PM (Additional fee would apply)" data-index="16">9PM-10PM (Additional fee would apply)</option>
                            <option value="10PM-11PM (Additional fee would apply)" data-index="17">10PM-11PM (Additional fee would apply)</option>
                            <option value="11PM-12Midnight (Additional fee would apply)" data-index="18">11PM-12Midnight (Additional fee would apply)</option>
                            <option value="12Midnight-1AM (Additional fee would apply)" data-index="19">12Midnight-1AM (Additional fee would apply)</option>
                            <option value="1AM-2AM (Additional fee would apply)" data-index="20">1AM-2AM (Additional fee would apply)</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Pickup Day<span>*</span></label>
                        <select name="pickup">
                            <option value="">Please select</option>
                            <option value="1-2 Business Days After" data-index="0">1-2 Business Days After</option>
                            <option value="1 Business Day After" data-index="1">1 Business Day After</option>
                            <option value="Same Day (Monday-Friday)" data-index="2">Same Day (Monday-Friday)</option>
                            <option value="Saturday (Additional fee applies)" data-index="3">Saturday (Additional fee applies)</option>
                            <option value="Sunday (Additional fee applies)" data-index="4">Sunday (Additional fee applies)</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-5">
                        <label>Pickup Time<span>*</span></label>
                        <select name="p_time">
                            <option value="">Please select</option>
                            <option value="8AM-6PM (Standard business hours)" data-index="0">8AM-6PM (Standard business hours)</option>
                            <option value="6AM-7AM (Additional fee would apply)" data-index="1">6AM-7AM (Additional fee would apply)</option>
                            <option value="7AM-8AM (Additional fee would apply)" data-index="2">7AM-8AM (Additional fee would apply)</option>
                            <option value="8AM-9AM (Additional fee would apply)" data-index="3">8AM-9AM (Additional fee would apply)</option>
                            <option value="9AM-10AM (Additional fee would apply)" data-index="4">9AM-10AM (Additional fee would apply)</option>
                            <option value="10AM-11AM (Additional fee would apply)" data-index="5">10AM-11AM (Additional fee would apply)</option>
                            <option value="11AM-12Noon (Additional fee would apply)" data-index="6">11AM-12Noon (Additional fee would apply)</option>
                            <option value="12Noon-1PM (Additional fee would apply)" data-index="7">12Noon-1PM (Additional fee would apply)</option>
                            <option value="1PM-2PM (Additional fee would apply)" data-index="8">1PM-2PM (Additional fee would apply)</option>
                            <option value="2PM-3PM (Additional fee would apply)" data-index="9">2PM-3PM (Additional fee would apply)</option>
                            <option value="3PM-4PM (Additional fee would apply)" data-index="10">3PM-4PM (Additional fee would apply)</option>
                            <option value="4PM-5PM (Additional fee would apply)" data-index="11">4PM-5PM (Additional fee would apply)</option>
                            <option value="5PM-6PM (Additional fee would apply)" data-index="12">5PM-6PM (Additional fee would apply)</option>
                            <option value="6PM-7PM (Additional fee would apply)" data-index="13">6PM-7PM (Additional fee would apply)</option>
                            <option value="7PM-8PM (Additional fee would apply)" data-index="14">7PM-8PM (Additional fee would apply)</option>
                            <option value="8PM-9PM (Additional fee would apply)" data-index="15">8PM-9PM (Additional fee would apply)</option>
                            <option value="9PM-10PM (Additional fee would apply)" data-index="16">9PM-10PM (Additional fee would apply)</option>
                            <option value="10PM-11PM (Additional fee would apply)" data-index="17">10PM-11PM (Additional fee would apply)</option>
                            <option value="11PM-12Midnight (Additional fee would apply)" data-index="18">11PM-12Midnight (Additional fee would apply)</option>
                            <option value="12Midnight-1AM (Additional fee would apply)" data-index="19">12Midnight-1AM (Additional fee would apply)</option>
                            <option value="1AM-2AM (Additional fee would apply)" data-index="20">1AM-2AM (Additional fee would apply)</option>
                        </select>
                    </div>
                    {{-- <div class="col-md-12 mt-5">
                        <div class="recaptcha text-right">
                            <iframe title="reCAPTCHA" width="304" height="78" role="presentation" name="a-lc29rt19qjxd" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LcMAqYZAAAAAGjZNBAyIZtXGv6VD2wtfRu7Fqko&amp;co=aHR0cHM6Ly9hbGwtb2NjYXNpb24tcmVudGFscy5jb206NDQz&amp;hl=en&amp;v=cwQvQhsy4_nYdnSDY4u7O5_B&amp;size=normal&amp;cb=evpchba08jqr"></iframe>
                        </div>
                    </div> --}}
                    <div class="col-md-12 mt-5">
                        <div class="qoute_btn">
                            <button class="btn w-100">SEND MESSAGE</button>
                        </div>
                    </div>
                </div>
            </form>
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
