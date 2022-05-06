<!DOCTYPE html>
<html lang="en">
  <head>
    @include('fixed.head')
    @yield('meta')
  </head>
<body>
  @include('fixed.header')
  <div id="wrap">
    @yield('content')
  </div>
</body>
  @include('fixed.footer')
  @include('fixed.scripts')
</html>