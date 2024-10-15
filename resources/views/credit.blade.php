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
                    <h3>Credit Card</h3>
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
            <h3 class="qoute_request_heading">Credit Card Authorization For All Occasion Rentals</h3>
            <form action="" class="qoute_form">
                <div class="row">
                    <div class="col-md-4">
                        <label for="1">first Name <span>*</span></label>
                        <input id="1" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4">
                        <label for="2">Last Name<span>*</span></label>
                        <input id="2" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4">
                        <label for="3">Email Address<span>*</span></label>
                        <input id="3" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="4">Esstimate or Order#<span>*</span></label>
                        <input id="4" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <h6 class="checkbox_title">Pickup Or Delivery</h6>
                        <div class="checkbox">
                            <div class="check">
                                <input id="11" type="radio" id="1" name="1" value="1">
                                <label for="11">Pickup</label><br>
                            </div>
                            <div class="check">
                                <input id="12" type="radio" id="2" name="1" value="2">
                                <label for="12">Delivery</label><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="5"></label>Deposit Made (Non Refundable deposit):<span>*</span></label>
                        <input id="5" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="6">Balance Due<span>*</span></label>
                        <input id="6" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="7">Total Due<span>*</span></label>
                        <input id="7" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="8">Card holder Name<span>*</span></label>
                        <input id="8" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="9">Card Street Address</label>
                        <input id="9" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="10">Card City<span>*</span></label>
                        <input id="10" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="13">Card State<span>*</span></label>
                        <input id="13" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="14">Card Zip<span>*</span></label>
                        <input id="14" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="15">Card Number<span>*</span></label>
                        <input id="15" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="16">Card Expiration<span>*</span></label>
                        <input id="16" type="text" class="form-control" placeholder="Enter">
                    </div>
                    <div class="col-md-4 mt-5">
                        <div class="input__feild">
                            <label for="17">Card Type<span>*</span></label>
                            <input id="17 " type="text" class="form-control" placeholder="Enter">
                        </div>

                    </div>
                    <div class="col-md-8 mt-5">
                        <div class="card__img">
                            <img src="images/card.png" alt="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="credit__con">
                            <p>By clicking send I authorize All Occasion Rentals to charge my credit card for the above referenced account/event. Any additional purchases, add‐on contracts, restocking, cleaning, replacement or service fees, late return charges, bounced checks (plus a $40 returned check fee) for the order hereby placed by me or my authorized agent(s) are also authorized to be charged to the credit card below</p>
                            <p>If the event location and client name is not the same as card holder, I, the card holder, warrant and guarantee payment of the above account. I agree not to dispute any charges to my credit card except in the case of fraud or defective merchandise, where immediate notification of such defect is made, at time of receipt.</p>
                            <p><b>I agree to the following cancellation policy;</b></p>
                            <ul>
                                <li>Cancellation 15 plus days to delivery/will-call = 70% refund of total contract.</li>
                                <li>Cancellation 7 to 15 days prior to delivery/will-call = 40% refund of total contract.</li>
                                <li>Cancellation 1 to 7 days of delivery/will-call = No refund</li>
                                <li>Final changes and counts to contract = 7 days prior to delivery/will-call</li>
                            </ul>
                            <p><b>Please note;</b></p>
                            <p><b>The following information must be an exact match to that of the issuing credit card company. A 3% service fee will be assessed if information is inaccurate.</b></p>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="recaptcha text-right">
                            <iframe title="reCAPTCHA" width="304" height="78" role="presentation" name="a-lc29rt19qjxd" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LcMAqYZAAAAAGjZNBAyIZtXGv6VD2wtfRu7Fqko&amp;co=aHR0cHM6Ly9hbGwtb2NjYXNpb24tcmVudGFscy5jb206NDQz&amp;hl=en&amp;v=cwQvQhsy4_nYdnSDY4u7O5_B&amp;size=normal&amp;cb=evpchba08jqr"></iframe>
                        </div>
                    </div>
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