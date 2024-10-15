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
                    <h3>Wishlist</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- pagetitle -->
<div class="pagetitle">
    <div class="pagetitle__waterMark">
  
        <?php // App\Helpers\Helper::inlineEditable("span",["class"=>""],'Wishlist','WISHLISTTXT3');?>

    </div>
</div>
<?php   $wishlist = App\Models\Wishlist::where('user_id',Auth::id())->get(); 
// dd($wishlist);
?>


<!-- Add To Cart -->




<div class="cart-page my-5">
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                   
                     
                        <th></th>
                    </tr>
                </thead>
                <tbody>
          
                    <tr>
                      
                        @forelse($wishlist as $k => $w)
                        <tr>
                            <td class="cart-product-thumbnail">
                                <a href="{{route('product-detail',$w['slug'])}}">
                                    <figure><img src="{{asset($w['img_path'])}}" class="img-responsive" alt="cart-1"></figure>
                                </a>
                                <div class="cart-product-content">
                                    <a href="{{route('product-detail',$w['slug'])}}">
                                        <h4>{{ucfirst($w['name'])}}</h4>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <h3 class="color-green">${{ number_format($w['price'],2)}}</h3>
                            </td>
                            <td>
                                <button class="btn btn-danger removewhishbtn" data-id="{{$w['product_id']}}">
                                    Remove from Wishlist
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                <h4>Wishlist is Empty</h4>
                            </td>
                        </tr>
                    @endforelse
                    
                           
                </tbody>
            </table>
        </div>
        <div class="cart-btns">
            <a href="{{route('products')}}" class="themeBtn">Continue Shopping</a>
            <!-- <a href="#" class="themeBtn">Update Cart</a> -->
        </div>
      
    </div>
</div>

@endsection
@section('css')
<style type="text/css">
	/*in page css here*/
    #demo {
  text-align: center;
  font-size: 60px;
  margin-top: 0px;
}
</style>
@endsection
@section('js')
<script type="text/javascript">
(()=>{
    var Loader = function () {

return {

    show: function () {
        jQuery("#preloader").show();
    },

    hide: function () {
        jQuery("#preloader").hide();
    }
};

}();

$('.update').click(function ()
		{
			var id = $(this).data("id");
            var qt = parseInt($(this).closest("div.num-in").find("input[name='qty']").val());
            console.log(qt);
                    if(qt <= 0){
                        qt = 1;
                        $.toast({
                        heading: 'Error!',
                        position: 'bottom-right',
                        text:  'Quantity Must be greater than 0!',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 6
                    });
                    return 0;
                    }
            
            var stock =  parseInt($(this).closest("div.num-in").find("input[name='stock_qty']").val());
            
           
            if(qt > stock)
            {
                    $.toast({
                        heading: 'Error!',
                        position: 'bottom-right',
                        text:  'Quantity Must be less than or equals to ' + stock,
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 6
                    });
            }
            else{

                qt = parseInt(qt);
                    var token = $('meta[name="csrf-token"]').attr("content");

                    var url = '{{ url('update-cart') }}';
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {rowid: id, qty:qt, _token:token},
                        success: function(){
                            $.toast({
                                heading: 'Success!',
                                position: 'bottom-right',
                                text:  'Quantity Updated',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 2000,
                                stack: 6
                            });
                                    //console.log('her');
                      setInterval(() => {
                        location.reload();
                      }, 2000);
                                    
                    return false;
                        },
                        // On fail
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
            }
                });

                // Remove Cart


        $('.couponbtn').click(function () {
			var couponcode = $("#code").val(); 
			var token = $('meta[name="csrf-token"]').attr("content");
			var url = '{{ url('apply-coupon')}}';
            
			$.ajax({
				url: url,
				type: 'post',
				data: {couponcode: couponcode, _token: token},
				success: function (response) {
                    console.log(response.status);
                    // $('.disprice').val(response.discoupon.coupon_price)
                    if(response.status == 0){
                        	$.toast({
						heading: 'Error!',
						position: 'bottom-right',
						text:  'Sorry have already use this Coupon',
						loaderBg: '#ff6849',
						icon: 'error',
						hideAfter: 3000,
						stack: 6
                        
					});
                 

                    }
                    if(response.status == 1){
					$.toast({
						heading: 'Success!',
						position: 'bottom-right',
						text:  'Coupon Actived',
						loaderBg: '#ff6849',
						icon: 'success',
						hideAfter: 3000,
						stack: 6
					});
                    setInterval(() => {
                        location.reload();
                      }, 2900);
                    }
                    if(response.status == 2){
                        	$.toast({
						heading: 'Error!',
						position: 'bottom-right',
						text:  'Invalid Coupon',
						loaderBg: '#ff6849',
						icon: 'error',
						hideAfter: 3000,
						stack: 6
                        
					});
                 

                    }

                    if(response.status == 3){
					$.toast({
						heading: 'Success!',
						position: 'bottom-right',
						text:  response.error,
						loaderBg: '#ff6849',
						icon: 'error',
						hideAfter: 3000,
						stack: 6
					});
                   
                    }
                    if(response.status == 4){
					$.toast({
						heading: 'Success!',
						position: 'bottom-right',
						text:  "Invalid Coupon",
						loaderBg: '#ff6849',
						icon: 'error',
						hideAfter: 3000,
						stack: 6
					});
                   
                    }
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
                    
				}
			});
		});


        
$( ".removewhishbtn" ).click(function(e) {
    
    var productid = $(this).data("id");
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    $.ajax({
        

        type: "post",

        url: "{{route('remove.from.wishlist')}}",

        data: {productid: productid },
        dataType: "json",


        success: function (msg) {
            if(msg.status == 1)
            {
                
        
                $.toast({
    				heading: 'Success!',
    				position: 'bottom-right',
    				text:  msg.msg,
    				loaderBg: '#ff6849',
    				icon: 'success',
    				hideAfter: 2000,
    				stack: 6
    			});
                setInterval(() => {
                        
                        location.reload();
                    }, 2050);
                     
    

            }
          
                                            
            },
            beforeSend: function () {
                
            }
        });

    });


        
})()
</script>
@endsection