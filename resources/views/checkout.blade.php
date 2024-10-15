@extends('layouts.main')
@section('content')
    <section class="hero-sec">
        <div class="banner-image">
            <img src="{{ asset('assets/images/bask-banner.png') }}" alt="">
        </div>
        <div class="hero-hd home-hero">
            <h1>CheckOut</h1>
        </div>
    </section>





    <!-- Banner Section End -->






    <!-- Cart Sec Start -->



    <section class="cart-sec">
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="checkout-form text-wit">


                        <div class="tab checkout-tabs">
                            <button class="tablinks active" onclick="openCity(event, 'checkout1')">Billing details</button>
                        </div>

                        <div id="checkout1" class="tabcontent" style="display: block;">
                            <form action="{{ route('placeorder') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label>First name *</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label>company *</label>
                                    <input type="text" name="company" value="{{ old('company') }}" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label>street1 *</label>
                                    <input type="text" name="street1" value="{{ old('street1') }}" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label>city *</label>
                                    <input type="text" name="city" value="{{ old('city') }}" >
                                </div>
                                <div class="col-md-6">
                                    <label>state *</label>
                                    <input type="text" name="state" value="{{ old('state') }}" >
                                </div>
                                <div class="col-md-6">
                                    <label>zip *</label>
                                    <input type="text" name="zip" value="{{ old('zip') }}" >
                                </div>
                                <div class="col-md-6">
                                    <label>country *</label>
                                    <input type="text" name="country" value="{{ old('country') }}" >
                                </div>
                                <div class="col-md-6">
                                    <label>phone *</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" >
                                </div>
                                <div class="col-md-6">
                                    <label>email *</label>
                                    <input type="text" name="email" value="{{ old('email') }}" >
                                </div>
                        </div>
                    </div>



                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-totals text-wit">
                        <h4>Your order</h4>
                        <ul>
                            <?php
                            $cart = Session::get('cart');
                            ?>
                            @foreach ($cart_data as $k => $v)
                                @if ($k != 'order_id')
                                    @php
                                        $product = App\Models\Products::where('id', $v['product_id'])->first();
                                    @endphp
                                    <li>
                                        <p>{{ ucfirst($product['title']) }}</p>
                                        <p>${{ $v['price'] }} x {{ $v['quantity'] }}</p>
                                        <p>${{ number_format($v['sub_total'], 2) }}</p>
                                    </li>
                                    <input type="hidden" name="product_id" value="{{ $v['product_id'] }}">
                                @endif
                            @endforeach

                            <li>
                                <p>Shipping</p>
                                <p class="order-price">${{ number_format($sub_total, 2) }}</p>
                            </li>
                            @if (isset($shipping))
                                <li>
                                    <p>Shipping Rating</p>
                                    <p>${{ number_format($shipping['shipping_value'], 2) }}</p>
                                </li>
                            @endif
                            <li>
                                <p>Total + Shipping Fee</p>
                                <p class="order-total">${{ number_format($total + $config['SHIPPINGPRICE'], 2) }}</p>
                                <input type="hidden" name="total_amount" value="{{ number_format($total + $config['SHIPPINGPRICE'], 2) }}">
                            </li>
                        </ul>
                        <div class="ad-crt-cta">
                            <button type="submit" class="add-to-cart check-btn">Place Order</button>
                        </div>
                    </div>
                </div>
                </form>
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
   $(document).ready(function() {
    function updateShippingRates() {
        var address = $('input[name="street1"]').val();
        var city = $('input[name="city"]').val();
        var state = $('input[name="state"]').val();
        var zip = $('input[name="zip"]').val();
        var total_amount = $('input[name="total_amount"]').val();

        if (address && city && state && zip) {
            var parcel = {
                length: '10',
                width: '10',
                height: '10',
                distance_unit: 'in',
                weight: '1',
                mass_unit: 'lb'
            };

            $.ajax({
                url: '{{ url("update-shipping") }}',
                type: 'POST',
                data: {
                    address: address,
                    city: city,
                    state: state,
                    zip: zip,
                    parcel: parcel,
                    total_amount: total_amount,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response && response.shipping_price !== undefined) {
                        var newTotalAmount = parseFloat(response.total_amount).toFixed(2);
                        $('.cart-totals .order-price').text('$' + parseFloat(response.shipping_price).toFixed(2));
                        $('input[name="total_amount"]').val(newTotalAmount);
                        $('.cart-totals .order-total').text('$' + newTotalAmount);
                    } else {
                        console.error('Invalid response or shipping price not found:', response);
                    }
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            });
        }
    }

    $('input[name="street1"], input[name="city"], input[name="state"], input[name="zip"]').on('change', updateShippingRates);
});
  </script>


    <script type="text/javascript">
        (() => {

//             $(document).ready(function() {
//     function updateShippingRates() {
//         var address = $('#address').val();
//         var address2 = $('#address2').val();
//         var city = $('#city').val();
//         var state = $('#state').val();
//         var zip = $('#zip').val();

//         // Example parcel data
//         var parcel = {
//             length: '10',
//             width: '8',
//             height: '6',
//             distance_unit: 'in',
//             weight: '2',
//             mass_unit: 'lb'
//         };

//         if (address && city && state && zip) {
//             $.ajax({
//                 url: '{{ url('update-shipping') }}', // Ensure this route exists
//                 type: 'POST',
//                 data: {
//                     address: address,
//                     address2: address2,
//                     city: city,
//                     state: state,
//                     zip: zip,
//                     parcel: parcel, // Add parcel data here
//                     _token: $('meta[name="csrf-token"]').attr('content'),
//                 },
//                 success: function(response) {
//                     console.log('Success:', response); // Log response
//                     if (response.shipping_price) {
//                         $('.cart-totals .order-price').text('$' + response.shipping_price);
//                         $('input[name="total_amount"]').val(response.total_amount);
//                     } else {
//                         console.error('Shipping price not found in response');
//                     }
//                 },
//                 error: function(xhr) {
//                     console.error('AJAX Error:', xhr.responseText);
//                 }
//             });
//         }
//     }

//     $('#address, #address2, #city, #state, #zip').on('change', updateShippingRates);
// });



            $(".changeqty").click(function() {
                var qty = $("#count2").val()
                var rowid = $("#count2").data('cart_id')
                var price = $("#count2").data('price')
                console.log(qty + " " + rowid + " " + " " + price)

                if ($(this).hasClass('minuss')) {
                    if (qty > 1) {
                        $("#count2").val(--qty)
                        var total = (price * qty)
                        $(".trash > h5").text("$" + total)
                    }
                } else if ($(this).hasClass('pluss')) {
                    $("#count2").val(++qty)
                    var total = (price * qty)
                    $(".trash > h5").text("$" + total)
                }

                var token = $('meta[name="csrf-token"]').attr("content");
                var url = '{{ url('update-cart') }}';
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        rowid: rowid,
                        qty: qty,
                        price: price,
                        _token: token
                    },
                    success: function() {
                        $.toast({
                            heading: 'Success!',
                            position: 'bottom-right',
                            text: 'Quantity Updated',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 2000,
                            stack: 6
                        });
                        setInterval(() => {
                            location.reload();
                        }, 2000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });


            })

            $('.cart-delete').click(function() {
                var id = $(this).data('id');
                var token = $('meta[name="csrf-token"]').attr("content");
                var url = '{{ url('remove-cart') }}';
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        rowid: id,
                        _token: token
                    },
                    success: function() {
                        $.toast({
                            heading: 'Success!',
                            position: 'bottom-right',
                            text: 'Item removed!',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3000,
                            stack: 6
                        });
                        setInterval(() => {
                            location.reload();
                        }, 2000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });


        })()
    </script>
@endsection
