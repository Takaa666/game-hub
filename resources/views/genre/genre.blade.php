@extends('layout.main')
@section('content')
<button onclick="create()" class="btn btn-success mt-4 my-4">Tambah Genre</button>

<table class="table table-hover" id="table">
  <thead class="thead mt-3">
    <tr>
      <th scope="col" class="text">Jenis Genre</th>
      <th scope="col"class="text">Action</th>
    </tr>
  </thead>
  <tbody class="tbody">

  </tbody>
</table>
@endsection
@push('script')
<script>
let dataTable;
        $(function() {
            dataTable = $('#table').DataTable({
                serverSide: true,
                ajax: '<?= route ('get-genre') ?>',
                columns : [
                    {data:'nama_genre'},
                    {data: 'id_genre' , class: 'text-center', render: function(data) {
                        return '<button type="button" class="btn btn-info btn-sm" onclick="view('+data+')">view</button>\n\
                            <button type="button" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</button>\n\
                            <button type="button" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</button>'
                    }},
                ]
            })
        })
    
  function create(){
        $.ajax({
          url: '<?= route('create-genre') ?>',
          success: function(response) {
              bootbox.dialog({
                  title: 'Tambah genre',
                  message: response
              })
          }
      })
  }

  function store() {
            $('#form-create .alert').remove()
            $.ajax({
                url: '<?= route('store-genre')?>',
                dataType: 'json', 
                type: 'post',
                data: $('#form-create').serialize(),
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

        function  update(id_genre) {
        $('#form-edit .alert').remove()
        $.ajax({
            url: '<?=route('update-genre')?>/'+id_genre,
            type: 'post',
            dataType: 'json',
            data: $('#form-edit'). serialize(),
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

    function edit(id_genre) {
            $.ajax({
                url: '<?= route('edit-genre') ?>/' + id_genre,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit genre',
                        message: response
                    })
                }
            })
        }
      
    function view(id_genre) {
      $.ajax({
          url: '<?= route('view-genre')?>/'+id_genre,
          success: function(response) {
              bootbox.dialog({
                  title: 'Data genre',
                  message : response
              })                    
          }
      })
    }

      function destroy(id_genre) {
            $.ajax({
                url: '<?= route('dellete-genre') ?>/'+id_genre,
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