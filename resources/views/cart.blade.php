@extends('layouts.main')
@section('content')


<section class="hero-sec">
    <div class="banner-image">
      <img src="{{asset('assets/images/bask-banner.png')}}" alt="">
    </div>
    <div class="hero-hd home-hero">
        <h1>Add To Cart</h1>
        </div>
</section>

<section class="cart-sec">

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="cart-tbl text-wit">
                    <div class="table-responsive">   
                        <table class="table">
                            <tr>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Subtotal
                                </th>
                            </tr>
                            @if (Session::has('cart') && !empty(Session::get('cart')))
                            @php
                                $cart = Session::get('cart');
                                $total = 0;
                            @endphp
                             @foreach ($cart as $k => $val)
                             @php
                                 if ($k == 'order_id') {
                                     continue;
                                 }
                                 $product = App\Models\Products::where('id', $val['product_id'])->first();
                                 $total += $val['sub_total'];
                             @endphp
                            <tr class="cart_data" data-rowid="{{ $val['cart_id'] }}">
                                <td>
                                    <div class="pro-cart">
                                        <a href="{{route('remove-cart',$val['cart_id'])}}" class="cart-delete" data-rowid="{{ $val['cart_id'] }}">X</a>
                                        <span><img src="{{ asset($product['img_path']) }}" alt=""></span>
                                        <h4>{{$product->title}}</h4>
                                        <h5>{{ $product['name'] }}</h5>
                                    </div>
                                </td>
                                <td>
                                    <p>${{ $val['price'] }}</p>
                                </td>
                                <td>
                                    <div class="cart-icons">
                                        <div class="qty-input">
                                            {{-- <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button> --}}
                                            <input type="text" class="count product-qty" value="{{ $val['quantity'] }}" data-price="{{ $val['price'] }}" data-cart_id="{{ $val['cart_id'] }}">
                                            {{-- <button class="qty-count qty-count--add" data-action="add" type="button">+</button> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>${{ $val['sub_total'] }}</p>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4">
                                    <div class="section-content text-center py-5">
                                        <div class="subHeading">There are currently no items present in the shopping cart.</div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        </table>
                    </div>

                    <div class="ad-crt-cta">
                        <div class="shop_btn">
                            <a href="{{route('products')}}" class="add-to-cart"><img src="{{asset('assets/images/arrow.png')}}" alt=""> Go Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cart-totals text-wit">
                    <div>
                        <h4>Cart Totals</h4>
                    </div>
                    <ul>
                    <li>
                        <b>Subtotal</b>
                        <span class="price">${{ isset($total) ? $total : 0 }}</span>
                    </li>
                    <li>
                        <b>Shipping</b>
                        <span class="price">${{$config['SHIPPINGPRICE']}}</span>
                    </li>
                    <span class="mid-text">Enter your address to view shipping options.<small>Calculate Shipping</small></span></span>
                    <li>
                        <b>Total</b>
                        <span class="price">${{ isset($total) ? $total + $config['SHIPPINGPRICE'] : 0 }}</span>
                    </li>
                </ul>

                    <div class="ad-crt-cta">
                        <a class="add-to-cart" href="{{route('checkout')}}">Proceed To Checkout</a>
                    </div>
                </div>
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
<script>
    $(document).ready(function() {
        $(".qty-count").on("click", function() {
            var $input = $(this).parent().find("input.product-qty");
            var action = $(this).data("action");
            var currentValue = parseInt($input.val());
            var maxQuantity = 10; // Maximum quantity allowed

            if (action === "minus" && currentValue > 0) {
                $input.val(currentValue - 1);
            } else if (action === "add" && currentValue < maxQuantity) {
                $input.val(currentValue + 1);
            }
        });
    });
</script>
    <script type="text/javascript">
        (() => {
            
           

            $(".changeqty").click(function() {
                var qty = $("#count2").val()
                var rowid = $("#count2").data('cart_id')
                var price = $("#count2").data('price')
                console.log(qty + " " + rowid + " " + " "+price)

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
