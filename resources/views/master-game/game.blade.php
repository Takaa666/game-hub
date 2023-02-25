@extends('layout.main')
@section('content')
<button onclick="create()" class="btn btn-success mt-4 my-4">Tambah Game</button>

<<div class="row mt-5">
  @foreach ($game as $games)
      <div class="col-md-3">
          <div class="card border-0 mt-5" style="max-width:250px;">
            <center>
              <img src="{{asset ('assets') }}\images\{{ $games->gambar_sampul}}" class="card-img-top" alt="..." style="max-width:280px;">
            </center>
              <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:orange;" >{{ $games->nama_game }}</h5>
                  <p class="card-text text-white">Developer: {{ $games->nama_perusahaan }}</p>
                  <p class="card-text text-white">Platform: {{ $games->jenis_platform }}</p>
                  <p class="card-text text-white">Genre: {{ $games->nama_genre }}</p>
                  <p class="card-text " style="color:grey">Harga: Rp.{{ $games->harga }}</p>
                  <div class="d-flex justify-content-end">
                    <a class="btn btn-warning" href="{{url ('/store/detail/'.$games->id_game)}}" role="button">Detail</a> <br>
                    <button class="btn btn-danger" type="button"onclick="destroy({{$games->id_game}})">Delete</button>
                    <button class="btn btn-success" type="button"onclick="edit({{$games->id_game}})">Edit</button>
                  </div>
                </div>
          </div>
      </div>
  @endforeach
</div>
@push('script')
<script>

  function create(){
        $.ajax({
          url: '<?= route('create-game') ?>',
          success: function(response) {
              bootbox.dialog({
                  title: 'Tambah game',
                  message: response
              })
          }
      })
  }

  function store() {
            $('#form-create .alert').remove()
            $.ajax({
                url: '<?= route('store-game')?>',
                dataType: 'json', 
                type: 'post',
                data: new FormData(document.getElementById('form-create')),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        alert('store berhasil')
                        bootbox.hideAll()
                        dataTable.ajax.reload()
                    } else {
                        alert('store gagal')
                    }
                }, error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    $('#form-create').prepend(errormessage(response));
                }
            })
        }
  
        function edit(id_game) {
            $.ajax({
                url: '<?= route('edit-master') ?>/' + id_game,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Game',
                        message: response
                    })
                }
            })
        }

        function  update(id_game) {
        $('#form-edit .alert').remove()
        $.ajax({
            url: '<?=route('update-game')?>/'+id_game,
            type: 'post',
            dataType: 'json',
            data: new FormData(document.getElementById('form-edit')),
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.success) {
                    alert('update berhasil')
                    bootbox.hideAll()
                    dataTable.ajax.reload()
                } else {
                    alert('store gagal')
                }
            }, error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                $('#form-edit').prepend(errormessage(response));
            }
        })
    }

    function destroy(id_game) {
            $.ajax({
                url: '<?= route('dellete-game') ?>/'+id_game,
                success: function(response) {
                    if(response.success) {
                        alert('Data Berhasil Di Hapus')
                        dataTable.ajax.reload()
                    } else {
                        alert('Data Gagal Di Hapus')
                    }
                }
            })
      }
    
      function errormessage(errors){
        let validations = '<div class="alert alert-danger">';
        validations += '<p><b>'+errors.message+'</b></p>';
        $.each(errors.errors, function(i, error){
            validations += error[0]+'<br>';
        });
        validations += '</div>';
        return validations;
    }


</script>
    
@endpush
    
@endsection