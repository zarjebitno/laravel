<!DOCTYPE html>
<html lang="en">
  @include('fixed.head')
<body>
  <div id="admin-wrap" class="d-flex">
    @include('admin.fixed.sidebar')
    <div id="content-wrapper" class="d-flex flex-column w-100">
      @yield('content')
    </div>
  </div>
</body>
  @include('fixed.scripts')
</html>