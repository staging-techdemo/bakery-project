<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . "    | Heaven Light Bakery" : " Heaven Light Bakery " }}</title>
    @include('layouts.links')
    @yield('css')
</head>
<input type="hidden" name="" id="web_base_url" value="{{url('/')}}">
<body>
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
    @include('layouts.scripts')
    @yield('js')
    <script type="text/javascript">
        (() => {

            @if (session('notify_success'))
                $.toast({
                    heading: 'Success!',
                    position: 'bottom-right',
                    text: '{{ session('notify_success') }}',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 2000,
                    stack: 6
                });
            @elseif (session('notify_error'))
                $.toast({
                    heading: 'Error!',
                    position: 'bottom-right',
                    text: '{{ session('notify_error') }}',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 2000,
                    stack: 6
                });
            @endif

        })()
    </script>
</body>
@include('layouts.errorhandler')
@include('admin.core.editor')
<div id="preloader" style="display:none;">
    <div class="loading">
        <span>Loading...</span>
    </div>
</div>

</html>
