@extends('layout.main')
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card border-0 ">
            <div class="d-flex justify-content-center">
              <div class="card-header" style="color: black;">{{ __('Hasil Spin Lucky Wheel') }}</div>
            </div>
              <div class="card-body">
                  @if (isset($lastVoucher))
                      <p style="color: orange;">Selamat! Anda mendapatkan diskon {{ $lastVoucher->jumlah_diskon }}%</p>
                      <p style="color: white;">Silahkan gunakan kode diskon ini saat melakukan pembayaran</p>
                  @else
                      <p style="color: white;">Anda belum pernah melakukan spin pada Lucky Wheel</p>
                      <div class="d-flex justify-content-center">
                    <a href="{{route("lucky-wheel-spin")}}" class="btn btn-warning">Ke Spinwheel</a>
                      </div>
                  @endif
                  
              </div>
          </div>
      </div>
  </div>
</div>
@endsection