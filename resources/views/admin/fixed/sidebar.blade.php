<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ @route('home') }}">
      <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
      <a class="nav-link" href="{{ @route('admin.index') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      Manage
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
      <a class="nav-link" href="{{ @route('admin.users.index') }}">
        <i class="fas fa-user"></i>
          <span>Users</span>
      </a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
      <a class="nav-link" href="{{ @route('admin.posts') }}">
            <i class="fas fa-book"></i>
          <span>Posts</span>
      </a>
  </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ @route('admin.comments') }}">
            <i class="fas fa-comments"></i>
            <span>Comments</span>
        </a>
    </li>


  <!-- Nav Item - Logout -->
  <li class="nav-item">
    <a class="nav-link" href="#">
        <form action="{{ @route('logout') }}" class="form-inline" method="POST">
          @csrf
          <button type="submit" class="nav-link btn btn-light text-secondary">Logout</button>
      </form>
    </a>
</li>

</ul>
<!-- End of Sidebar -->