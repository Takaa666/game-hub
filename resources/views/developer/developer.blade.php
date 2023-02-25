@extends('layout.main')
@section('content')

<button onclick="create()" class="btn btn-success mt-4 my-4">Tambah Developer</button>

<table class="table table-hover" id="table">
  <thead class="thead mt-3">
    <tr>
      <th scope="col" class="text">Nama Perusahaan</th>
      <th scope="col"class="text">Website Perusahaan</th>
      <th scope="col"class="text">Alamat Perusahaan</th>
      <th scope="col"class="text">Nomor Perusahaan</th>
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
                ajax: '<?= route ('get-developer') ?>',
                columns : [
                    {data:'nama_perusahaan'},
                    {data: 'website_perusahaan'},
                    {data: 'alamat_perusahaan'},
                    {data: 'no_perusahaan'},
                    {data: 'id_developer' , class: 'text-center', render: function(data) {
                        return '<button type="button" class="btn btn-info btn-sm" onclick="view('+data+')">view</button>\n\
                            <button type="button" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</button>\n\
                            <button type="button" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</button>'
                    }},
                ]
            })
        })
    
        function create(){
      $.ajax({
        url: '<?= route('create-developer') ?>',
        success: function(response) {
            bootbox.dialog({
                title: 'Tambah Developer',
                message: response
            })
        }
    })
  }

  function store() {
            $('#form-create .alert').remove()
            $.ajax({
                url: '<?= route('store-developer')?>',
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

        function  update(id_developer) {
        $('#form-edit .alert').remove()
        $.ajax({
            url: '<?=route('update-developer')?>/'+id_developer,
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

    function edit(id_developer) {
            $.ajax({
                url: '<?= route('edit-developer') ?>/' + id_developer,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Developer',
                        message: response
                    })
                }
            })
        }
      
    function view(id_developer) {
      $.ajax({
          url: '<?= route('view-developer')?>/'+id_developer,
          success: function(response) {
              bootbox.dialog({
                  title: 'Data Developer',
                  message : response
              })                    
          }
      })
    }

      function destroy(id_developer) {
            $.ajax({
                url: '<?= route('dellete-developer') ?>/'+id_developer,
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
