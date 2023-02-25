@extends('layout.main')
@section('content')
<table class="table table-hover" id="table">
  <thead class="thead mt-3">
    <tr>
      <th scope="col" class="text">Email</th>
      <th scope="col" class="text">Judul Game</th>
      <th scope="col" class="text">Total</th>
      <th scope="col" class="text">Status</th>
      <th scope="col"class="text">Action</th>
    </tr>
  </thead>
  <tbody class="tbody">

  </tbody>
</table>

@push('script')
    <script>

let dataTable;
        $(function() {
            dataTable = $('#table').DataTable({
                serverSide: true,
                ajax: '<?= route ('get-transaksi') ?>',
                columns : [
                    {data:'email'},
                    {data:'nama_game'},
                    {data:'total'},
                    {data:'status'},
                    {data: 'id_transaksi' , class: 'text-center', render: function(data) {
                        return '<button type="button" class="btn btn-info btn-sm" onclick="view('+data+')">view</button>\n\
                            <button type="button" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</button>\n\
                            <button type="button" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</button>'
                    }},
                ]
            })
        })
 
        function edit(id_transaksi) {
            $.ajax({
                url: '<?= route('edit-transaksi') ?>/' + id_transaksi,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Transaksi',
                        message: response
                    })
                }
            })
        }

        
        function  update(id_transaksi) {
        $('#form-edit .alert').remove()
        $.ajax({
            url: '<?=route('update-transaksi')?>/'+id_transaksi,
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

    $(document).ready(function() {
      $('#lastspin').on('change', function() {
        if ($(this).is(':checked')) {
          var diskon=$('#diskon').val();
          var total=$('#harga').val()*$('#diskon').val()/100;
          // Checkbox dicentang, tampilkan form untuk memilih diskon
          $('#total-form').val(total);
        } else {
          // Checkbox tidak dicentang, sembunyikan form untuk memilih diskon
          $('#total-form').val($('#harga').val());
        }
      });
    });


    function view(id_transaksi) {
      $.ajax({
          url: '<?= route('view-transaksi')?>/'+id_transaksi,
          success: function(response) {
              bootbox.dialog({
                  title: 'Data Pembelian',
                  message : response
              })                    
          }
      })
    }

      function destroy(id_transaksi) {
            $.ajax({
                url: '<?= route('dellete-transaksi') ?>/'+id_transaksi,
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