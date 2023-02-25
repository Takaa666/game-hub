<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('assets')}}\css\style.css">
  <title>Register</title>
</head>
<body>
</div>
<section class="vh-100">
  <div class="container pt-5">
    <div class="row d-flex justify-content-center pt-5">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card text-white" style="background-color: #F94A29;">
          <div class="card-body p-5 text-center">
            <div class="mb-md-4 pb-5">
              <h2 class="fw-bold mb-5 text-uppercase">Register</h2>
                <form method="post" action="{{route('store-register-admin')}}">
                  @csrf
                  <div class="form-outline form-white mb-4 ">
                    <input type="text" name="name" class="form-control form-control-lg @error('name')is-invalid @enderror " id="name" required value="{{old('name')}}"/>
                    <label class="form-label">Nama Perusahaan</label>
                    @error('name')
                    <div class="invalid-feedback">
                     {{$message}}
                    </div>
                    @enderror
                  </div>
                <div class="form-outline form-white mb-4">
                  <input type="text" name="email" class="form-control form-control-lg @error('email')is-invalid @enderror" id="email"required value="{{old('email')}}"/>
                  <label class="form-label">Email Perusahaan</label>
                  @error('email')
                    <div class="invalid-feedback">
                     {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-outline form-white mb-4">
                  <input type="password" name="password" class="form-control form-control-lg @error('password')is-invalid @enderror"" id="password" required />
                  <label class="form-label" >Password</label>
                  @error('email')
                  <div class="invalid-feedback">
                   {{$message}}
                  </div>
                  @enderror
                </div>
                <button class="btn btn-outline-light btn-lg px-5" type="submit">Daftar</button>
              </form> 
            </div>
            <div>
              <p class="mb-0"><a href="{{url('/')}}" class="text-white-50 fw-bold">Masuk</a>
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