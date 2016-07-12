<!DOCTYPE html>
<html>
<head>
  @yield('head.before')
  <link href="{{ url('style/app.css') }}" />
  <script src="{{ url('script/vile.js') }}"></script>
  @yield('head.after')
</head>
<body>
  <header class='header'>
    
  </header>
  @yield('body.content')
</body>
</html>
