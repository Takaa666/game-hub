@extends('layout.main')
@section('content')



  {{-- SIDEBAR --}}


  <div class="mx-auto mt-5">
    <div class="mx-auto">
      <h1 class="fw-bold text-center" style="color:orange">Penawaran Spesial</h1>
    </div>

  {{-- CAROUSEL --}}
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @foreach ($displays as $display)
      <div  onclick="window.location.href ='{{ route('detail-game', ['id_game' => $display->id_game]) }}'" class="carousel-item @if ($loop->first) active @endif">
        <center>
          <img src="{{asset('assets')}}/images/{{$display->gambar_display}}" style="max-width:1200px;" class="d-block w-100" alt="...">
        </center>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="fw-bolder" style="color:rgb(255, 174, 0);">{{ $display->nama_game }}</h5>
          <p> Rp: {{ $display->harga }}</p>
        </div>
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  {{-- CARD GAME --}}
  <div class=" container mt-5 pt-5">
    <div class="row d-flex">
      <div class="col">
        <div>
          <h1 class="fw-bold " style="color:orange"> Games</h1>
        </div>
      </div>
      <div class="col">
        <div class="d-flex justify-content-end">
          <form action="/search" method="GET">
            <input type="text" name="query">
            <button  class="btn btn-warning"  type="submit">Search</button>
        </form>
        </div>
      </div>
    </div>
  

  <div class="row mt-5 mx-auto">
    @foreach ($game as $games)
        <div class="col-md-3">
            <div class="card border-0 mt-5" style="max-width:250px;">
              <center>
                <img src="{{asset ('assets') }}\images\{{ $games->gambar_sampul}}" class="card-img-top" alt="..." style="max-width:280px;">
              </center>
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="color:orange;" >{{ $games->nama_game }}</h5>
                    <p class="card-text text-white">Developer: {{ $games->Developer->nama_perusahaan }}</p>
                    <p class="card-text text-white">Platform: {{ $games->platform->jenis_platform }}</p>
                    <p class="card-text text-white">Genre: {{ $games->genre->nama_genre }}</p>
                    <p class="card-text "style="color:grey">Harga: Rp.{{ $games->harga }}</p>
                    <div class="d-flex justify-content-end">
                      <a class="btn btn-warning" href="{{url ('/store/detail/'.$games->id_game)}}" role="button">Detail</a>
                    </div>
                  </div>
            </div>
        </div>
    @endforeach
  </div>
</div>
  </div>
</div>

    
    
@endsection