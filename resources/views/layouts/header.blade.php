
<body>
<!-- Header Start -->
<!-- <div class="container"> -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="{{route('welcome')}}"><img src="{{asset($logo->img_path)}}" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="{{route('welcome')}}">Home <span class="sr-only">(current)</span></a>
              </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{route('shop')}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Shop
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{route('shop')}}">Chocolate Cake</a>
                  <a class="dropdown-item" href="{{route('shop')}}">Pineapple Cake</a>
                  <a class="dropdown-item" href="{{route('shop')}}">Special Cake</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('about')}}">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="{{route('create-basket')}}">Create Basket</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="{{route('special-offer')}}">Special Offers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="{{route('blog')}}">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="{{route('contact')}}">Contact</a>
              </li>
            </ul>
            
          </div>
          <div class="search__main">
            <form action="{{route('products')}}" class="header__form">
                <input type="text" name="search" placeholder="Search" value="{{isset($_GET['search']) ? $_GET['search'] : ''}}">
            </form>
          </div>
        
          <div class="hdr-btns">
            <a href="{{route('cart')}}"><i class="fa fa-cart-arrow-down"></i></a>
            @if (Auth::check()))
            <a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            <a href="{{route('dashboard.index')}}"><i class="fa fa-address-card" aria-hidden="true"></i></a>
            @else
            <a href="{{route('login')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
            @endif
            </div>
        </nav>
        </div>
        </header>
        
            <!-- Header End -->
    