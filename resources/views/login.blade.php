<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('assets')}}\css\style.css">
  <title>Login</title>
</head>
<body>

  
<section class="vh-100">
  <div class="container pt-5" >
    <div class="row d-flex justify-content-center pt-5">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        @if (session()->has('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        @endif

        @if (session()->has('loginError'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        @endif

        <div class="card text-white" style="background-color: #F94A29;">
          <div class="card-body p-5 text-center">
            <div class="mb-md-4 pb-5">
              <h2 class="fw-bold mb-5 text-uppercase">Masuk</h2>
              <form method="post" action="{{route('auth-login')}}">
                @csrf
                <div class="form-outline form-white mb-4">
                  <input type="email" name="email" class="form-control form-control-lg @error ('email') is-invalid  @enderror " id="email" autofocus required value="{{old('email')}}"/>
                  <label class="form-label" for="email">E-mail</label>
                  @error('email')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="form-outline form-white mb-4">
                  <input type="password" name="password" class="form-control form-control-lg" id="password" required />
                  <label class="form-label" for="password">Password</label>
                </div>
                <p class="small pb-lg-2"><a class="text-white-50" href="">Lupa password?</a></p>
                <button class="btn btn-outline-light btn-lg px-5" type="submit">Masuk</button>
              </form> 
            </div>
            <div>
              <p class="mb-0">Tidak mempunyai akun? <a href="{{url('/register')}}" class="text-white-50 fw-bold">Daftar</a>
              </p>
            </div>
            <div>
              <p class="mb-0">Buat Akun Developer <a href="{{url('/register-admin')}}" class="text-white-50 fw-bold">Daftar</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>