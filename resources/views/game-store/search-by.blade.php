@extends('layout.main')
@section('content')

<h1 style="color:orange;" class="fw-bold"> Hasil Pencarian </h1>
  <div class="d-flex justify-content-end">
    <form action="/search" method="GET">
      <input type="text" name="query">
      <button  class="btn btn-warning"  type="submit">Search</button>
  </form>
</div>
<div class="container">
  <div class="row mt-5">
    @foreach ($game as $games)
        <div class="col-md-3">
            <div class="card border-0 mt-5" style="max-width:250px;">
              <center>
                <img src="{{asset ('assets') }}\images\{{ $games->gambar_sampul}}" class="card-img-top" alt="..." style="max-width:280px;">
              </center>
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="color:orange;" >{{ $games->nama_game }}</h5>
                    <p class="card-text text-white">Developer: {{ $games->Developer->nama_perusahaan}}</p>
                    <p class="card-text text-white">Platform: {{ $games->platform->jenis_platform }}</p>
                    <p class="card-text text-white">Genre: {{ $games->genre->nama_genre }}</p>
                    <p class="card-text text-white">Harga: Rp.{{ $games->harga }}</p>
                    <div class="d-flex justify-content-end">
                      <a class="btn btn-warning" href="{{url ('/store/detail/'.$games->id_game)}}" role="button">Detail</a>
                    </div>
                  </div>
            </div>
        </div>
    @endforeach
  </div>
</div>


@endsection