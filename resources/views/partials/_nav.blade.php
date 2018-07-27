  <!-- Default bootstrap Navbar -->
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <a class="navbar-brand" href="#">Blog</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{Request::is('/')? "active":""}}">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item {{Request::is('blog')? "active":""}}">
          <a class="nav-link" href="/blog">Blog</a>
        </li>
        <li class="nav-item {{Request::is('about')? "active":""}}">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item {{Request::is('contact')? "active":""}}">
          <a class="nav-link" href="/contact">Contact</a>
        </li>
      </ul>
      @if(Auth::check())
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
     {{ Auth::user()->name }}
    </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{ route('posts.index') }}">Posts</a>
          <a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a>
          <a class="dropdown-item" href="{{ route('tags.index') }}">Tags</a>
          <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
        </div>
      </div>
      @else
      <a href="{{ route('login') }}" class="btn btn-default">Login</a>
      <a href="{{ route('register') }}" class="btn btn-default">Register</a>
      @endif
    </div>
  </nav><!-- End of navbar -->
