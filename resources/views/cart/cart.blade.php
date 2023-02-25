@extends('layout.main')
@section('content')

<h2 class="text-white mt-5">Keranjang Anda</h2>
<div class="">
  <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
    <div class="col-md-2">
      <div class="card border-0" style="max-width: 200px">
        <center> 
          <img src="{{asset('assets')}}\images\valhalla.jpeg" class="card-img-top" alt="...">
      </center>
        <div class="card-body ">
          <h5 class="card-title text-white">Assasin Creed Valhalla</h5>
          <p class="card-text" style="color:darkgrey">PC</p>
          <p class="card-text" style="color:orange">Rp.149.000,00</p>
          <div class="d-flex justify-content-end">
            <button class="buy" style="">
              <span>Buy</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card border-0" style="max-width: 200px">
        <img src="{{asset('assets')}}\images\valhalla.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title text-white">Assasin Creed Valhalla</h5>
          <p class="card-text"style="color:darkgrey">PC.</p>
          <p class="card-text" style="color: orange";>Rp.149.000,00</p>
          <div class="d-flex justify-content-end">
            <button class="buy">
              <span>Buy</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card border-0" style="max-width: 200px">
        <img src="{{asset('assets')}}\images\pes.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title text-white">eFootball PES 2021</h5>
          <p class="card-text"style="color:darkgrey">PC </p>
          <p class="card-text" style="color:orange">Rp.200.000,00 </p>
          <div class="d-flex justify-content-end">
            <button class="buy">
              <span>Buy</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card border-0" style="max-width: 200px">
        <img src="{{asset('assets')}}\images\valhalla.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title text-white">Assasin Creed Valhalla</h5>
          <p class="card-text"style="color:darkgrey">PC</p>
          <p class="card-text" style="color: orange">Rp.149.000,00 </p>
          <div class="d-flex justify-content-end">
            <button class="buy">
              <span>Buy</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
@endsection