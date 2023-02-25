@extends('layout.main')
@section('content')
<div class="container">
    <h1 class="text-white">Spin Ghoib</h1>
    <p class="text-white">Dapatkan Diskon Ghoib Anda Dengan MMencet Tombol Putar!</p>
    <hr>

    <div class="text-center">
        <div class="lucky-wheel">
            <div class="segment text-white"><span>Disc 5%</span></div>
            <div class="segment text-white"><span>Disc 10%</span></div>
            <div class="segment text-white"><span>Disc 5%</span></div>
            <div class="segment text-white"><span>Disc 15%</span></div>
            <div class="segment text-white"><span>Disc 5%</span></div>
            <div class="segment text-white"><span>Disc 10%</span></div>
        </div>
        <button id="spin-btn"  class="btn btn-primary mt-4">Putar</button>
    </div>
</div>
@endsection
@push('script')
<script>
  $(document).ready(function() {
    $('#spin-btn').click(function() {
        $.ajax({
            url: '{{ route("lucky-wheel-spin") }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Redirect ke halaman hasil spin
                    window.location.href = '{{ route("lucky-wheel") }}';
                } else {
                    // Tampilkan pesan error
                    alert(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    });
});
</script>
@endpush

 
            