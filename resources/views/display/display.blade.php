@extends('layout.main')
@section('content')
<button onclick="create()" class="btn btn-success mt-4 my-4">Tambah Display</button>

<table class="table table-hover" id="table">
  <thead class="thead mt-3">
    <tr>
      <th scope="col" class="text">Nama Game</th>
      <th scope="col" class="text">Gambar Display</th>
      <th scope="col" class="text">Harga</th>
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
                ajax: '<?= route ('get-display') ?>',
                columns : [
                    {data:'nama_game'},
                    {data:'gambar_display'},
                    {data:'harga'},
                    {data: 'id_display' , class: 'text-center', render: function(data) {
                        return '<button type="button" class="btn btn-info btn-sm" onclick="view('+data+')">view</button>\n\
                            <button type="button" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</button>'
                    }},
                ]
            })
        })


function create(){
        $.ajax({
          url: '<?= route('create-display') ?>',
          success: function(response) {
              bootbox.dialog({
                  title: 'Tambah Display',
                  message: response
              })
          }
      })
  }

  function store() {
            $('#form-create .alert').remove()
            $.ajax({
                url: '<?= route('store-display')?>',
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
    
        function view(id_display) {
      $.ajax({
          url: '<?= route('view-display')?>/'+id_display,
          success: function(response) {
              bootbox.dialog({
                  title: 'Data Display',
                  message : response
              })                    
          }
      })
    }

    function  update(id_display) {
        $('#form-edit .alert').remove()
        $.ajax({
            url: '<?=route('update-display')?>/'+id_display,
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

        function edit(id_display) {
            $.ajax({
                url: '<?= route('edit-display') ?>/' + id_display,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Display',
                        message: response
                    })
                }
            })
        }

        function destroy(id_display) {
            $.ajax({
                url: '<?= route('dellete-display') ?>/'+id_display,
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

</script>
    
@endpush