<style>

</style>

@extends('layout.main')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <h2 class="mb-4 fw-bold" style="color: orange">{{$model->nama_game}}</h2>
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <img src="{{asset('assets')}}/images/{{$model->gambar_detail}}" class="card-img-top" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-5 border-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h3 class="text-white fw-bold"> Rp.{{$model->harga}}</h3>
          </div>
          <div class="col d-flex justify-content-end">
            @if ($model->status)
            <div class="btn btn-warning">Install</div>
            @else
            <a href="{{route('create-transaksi', ['id_game' => $model->id_game])}}" class="btn btn-primary mx-3">Beli</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  
    <div class="card mt-3 border-0">
      <div class="card-body">
        <p class="card-text " style="color:orange"{{$model->nama_game}}</p>
        <p class="card-text text-white">Genre :{{$model->genre->nama_genre}}</p>
        <p class="card-text text-white">Developer :{{$model->Developer->nama_perusahaan}}</p>
        <p class="card-text text-white">Platform :{{$model->platform->jenis_platform}}</p>
        <p class="card-text text-white">Deskripsi :  {{$model->deskripsi}}</p>
        <p class="card-text text-white">WEbsite Developer: {{$model->Developer->website_perusahaan}} </p>
      </div>
    </div>

    <h3 class="text-white mt-5">Komentar</h3>
    <form method="POST" action="{{route ('store-komentar') }}">
      @csrf
      <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
      <input type="hidden" name="id_game" value="{{$model->id_game}}">
      <div class="form-inline">
          <div class="form-group">
              <label for="komentar">Komentar:</label>
              <textarea name="komentar" class="form-control" id="komentar" rows="4"></textarea>
          </div>
          <button class="btn btn-light mt-4 d-flex justify-content-end" type="submit">Kirim</button>
      </div>
  </form>

  @if ($komentar != null && $komentar->count() > 0)
    <h2>Komentar</h2>
    @foreach($komentar as $comment)
        <div class="card mb-3" style="background-color:#333333;">
            <div class="card-header" style="color:orange;">
                {{ $comment->users->name }}
            </div>
            <div class="card-body text-white">
                {{ $comment->komentar }}
            </div>
            <div class="d-flex justify-content-end mt-3">
              <form method="POST" action="{{ route('delete-komentar', ['id_komentar' => $comment->id_komentar]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            </div>
        </div>
    @endforeach
  @endif




  </div>


@endsection