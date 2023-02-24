<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
    <body>
        @include('partials.menu')
        <main class="container">
          <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
            <div class="col-md-6 px-0">
              <h1 class="display-4 fst-italic">{{ $mainNews->title }}</h1>
              <p class="lead my-3">{{ Str::limit($mainNews->title, 50, ' (...)') }}</p>
              <p class="lead mb-0"><a href="{{ route('news-detail', $mainNews->id) }}" class="text-white fw-bold">Continue reading...</a></p>
            </div>
          </div>

          <div class="row mb-2">
            @foreach($news as $n)
            <div class="col-md-6">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-2 text-primary">{{ $n->category->title }}</strong>
                  <h3 class="mb-0">{{ Str::limit($n->title, 50, ' (...)') }}</h3>
                  <div class="mb-1 text-muted">{{ $n->created_at->diffForHumans() }}</div>
                  <a href="{{ route('news-detail', $n->id) }}" class="stretched-link">Continue reading</a>
                  <p>{{ count($n->comments) }} comments</p>
                </div>
                <div class="col-auto d-none d-lg-block">
                  <img class="bd-placeholder-img" width="200" height="250" src="{{ $n->image_url }}"><title>Placeholder</title>
                </div>
              </div>
            </div>
            @endforeach
        </main>

        @include('partials.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
