<!-- Navigation bar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">MyBlog</a>
      </div>
      <nav role="navigation" class="collapse navbar-collapse navbar-right">
        <ul class="navbar-nav nav">
          
          <li class="{{ request()->is('/') ? 'active' : '' }}">
              <a href="{{ url('/') }}">Home</a>
          </li>
          <li class="{{ request()->is('my-blog') ? 'active' : '' }}">
              <a href="{{ url('my-blog') }}">MyBlog</a>
          </li>
          <li class="{{ request()->is('post-blog') ? 'active' : '' }}">
              <a href="{{ url('post-blog') }}">Post Blog</a>
          </li>
      
          @guest  <!--  user is not login -->
              <li class="{{ request()->is('register') ? 'active' : '' }}">
                  <a href="{{ url('register') }}">Register</a>
              </li>
              <li class="{{ request()->is('login') ? 'active' : '' }}">
                  <a href="{{ url('login') }}">Login</a>
              </li>
          @endguest
      
          @auth
              <li>
                  <a href="{{ url('logout') }}" 
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     Logout
                  </a>
      
                  <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </li>
          @endauth
      </ul>
      
      
      </nav>
    </div>
  </div><!-- End Navigation bar -->