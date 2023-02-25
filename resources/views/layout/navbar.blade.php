
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid d-flex flex-end">
    <a class="navbar-brand" href="#">
      <img src="{{asset('assets')}}\images\logo.svg" alt="" width="30" height="24">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/store')}}">Game Store</a>
        </li>
        @if (auth()->user()->role=='admin' || auth()->user()->role=='user')
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/lucky-wheel">Lucky Wheels</a>
        </li>
        @endif

        @if (auth()->user()->role=='admin')

        <div class="dropdown">
          <button class="btn dropdown-toggle" style="color:white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Master Data
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{url ('/transaksi')}}">Transaksi</a></li>
            <li><a class="dropdown-item" href="{{url ('/developer')}}">Master Developer</a></li>
            <li><a class="dropdown-item" href="{{url ('/platform')}}">Master Platform</a></li>
            <li><a class="dropdown-item" href="{{url ('/genre')}}">Master Genre</a></li>
            <li><a class="dropdown-item" href="{{url ('/display')}}">Master Display</a></li>
            <li><a class="dropdown-item" href="{{url ('/user')}}">Master User</a></li>
          </ul>
        </div>
       
        @endif
        @if (auth()->user()->role=='developer')
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/master-game')}}">Master Game</a>
        </li>
        @endif
      </ul>
    </div>
    {{-- <form class="form-inline" action="/search" method="GET">
      <input class="form-control" type="text" name="query" placeholder="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
  </form> --}}
        <div class="text-white">
          <ul class="navbar-nav">
            @auth
            <li class="nav-item dropdown">
              <a  class="nav-link dropdown-togle" href="" id="navbarDropdowm" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Selamat Datang {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <form action="/logout" method="GET">
                  @csrf
                  <button type="submit" class="dropdown-item">
                    <i class="bi bi-box-arrow-right"></i>Logout</button>
                  </form>
                </ul>
              </li>    
        </div>
            
            @endauth
          </ul>         
        </div>
    </nav>

