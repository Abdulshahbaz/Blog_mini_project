<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MyBlogs</span>
    </a> 
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>                                                                                       
        <div class="info">
         <a href="#" class="d-block">MyBlog</a> {{--  {{Auth::guard('admin')->user()->name}} --}}
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="{{route('admin.dashboard')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Posts List
              </p>
            </a> 
          <li class="nav-item">
            <a href="{{route('users.list')}}" class="nav-link">                      
              <i class="nav-icon far fa-image"></i>
              <p>
                Users Details
              </p>
            </a>
          </li>       
          <li class="nav-item">
              <a href="{{ url('logout') }}" 
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();"class="nav-link">
                 <i class="nav-icon far fa-image"></i>
                 <p>
                   Logout
                 </p>
              </a>
              <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </li>
        </ul>
      </nav>
    </div>
</aside>     