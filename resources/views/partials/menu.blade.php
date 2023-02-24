<div class="container">
  <header class="blog-header lh-1 py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <!--
      <div class="col-4 pt-1">
        <a class="link-secondary" href="">Subscribe</a>
      </div>
      -->
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{ route('news')}}">Blog ITIS Rossi</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <!--
        <a class="link-secondary" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>
        -->
        @if(Session::get('logged'))
        <a class="btn btn-sm btn-outline-secondary me-3" href="{{ route('auth.logout') }}">Logout</a>
        @else
        <a class="btn btn-sm btn-outline-secondary me-3" href="{{ route('auth.register') }}">Sign up</a>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('auth.login') }}">Sign in</a>
        @endif
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-around">
    @if(!isset($no_categories))
      @php
        $categories = \App\Models\Category::all();
      @endphp
      @foreach($categories as $category)
        <a class="p-2 link-secondary" href="{{ route('news-category', $category->id)}}">{{ $category->title }}</a>
      @endforeach
    @endif
    </nav>
  </div>
</div>