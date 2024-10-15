<footer>
    <div class="section-footer">
      <div class="container">
        <div class="row">
          
        
        
        <div class="col-md-3">
            <div class="img-social">
              <img src="{{$logo->img_path}}" alt="">
              </div>
          <div class="social-media">
          <a href="{{$config['FACEBOOK']}}">
                <i class="fa fa-facebook-f" aria-hidden="true"></i>
              </a>
              <a href="{{$config['INSTAGRAM']}}">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="{{$config['LINKEDIN']}}">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="{{$config['TWITTER']}}">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
          </div>
        
        </div>
        
    
        <div class="col-md-3">
            <div class="footer-cont">
                <h4>Opening Restaurant</h4>
                <p>Sat-Wet: 09:00am-10:00PM Thursdayt: 09:00am-11:00PM Friday: 09:00am-8:00PM</p>
            </div>
        </div>
    
    
        <div class="col-md-3">
            <div class="footer-cont">
                <h4>Opening Restaurant</h4>
                <ul>
    <a href="{{route('about')}}"><li>About Us</li></a>
    <a href="{{route('contact')}}"><li>Contact Us</li></a>
    <a href=""><li>Order Delivery</li></a>
    <a href=""><li>Payment & Tax</li></a>
    <a href=""><li>Terms of Services</li></a>
    </ul>
            </div>
        </div>
        
    
    
        <div class="col-md-3">
            <div class="footer-cont">
                <h4>User Link</h4>
                <p>1234 Dolor Sit Elite Ave Lorem 123456, Ipsum, UK</p>
                <a href="tel:{{$config['COMPANYPHONE']}}">{{$config['COMPANYPHONE']}}</a>
            </div>
           <div class="newsletter">
           <div class="nws-ltr">
            <form action="{{route('newsletter_submit')}}" method="POST">
              @csrf
            <input type="email" placeholder="Email" name="email" required>
            <button type="submit">Submit</button>
          </form>
            </div>
           </div>
        </div>
    
    
    
    
    
    </div>
      </div>
    </div>
    <div class="copyrit">
      <p>© Copyright 2024 Heaven Light Bakery | All Rights Reserved.</p>
    </div>
        </footer>

</body>

