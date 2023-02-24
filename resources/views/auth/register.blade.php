<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
    <body>
        @include('partials.menu')
        <main class="container">
        
            <div class="row justify-content-md-center mt-5 mb-5">
                <div class="col-md-auto">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('auth.do-register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text"
                            name="name" 
                            value="{{ old('name') }}"
                            class="form-control" 
                            aria-describedby="emailHelp" 
                            placeholder="Enter name" 
                            required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Surname</label>
                            <input type="text"
                            name="surname"
                            value="{{ old('surname') }}"
                            class="form-control"
                            aria-describedby="emailHelp"
                            placeholder="Enter surname"
                            required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control"
                            aria-describedby="emailHelp"
                            placeholder="Enter email"
                            required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype Confirm" required>
                        </div>
                        <div class="form-group mt-2 text-center">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        @include('partials.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
