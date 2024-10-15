{{-- -----------------------------------Links to Change----------------------------------- --}}

<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/fontawesome.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<link rel="preload" href="Rasa-Regular.woff2" as="font" type="font/woff2" crossorigin>
<script>
    AOS.init();
  </script>
{{-- -----------------------------------Links to Change----------------------------------- --}}


<script src="{{ asset('dash/js/jquery.toast.js') }}"></script>
@if (Auth::guard('admin'))
    <script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/content-management.js') }}"></script>
@endif
