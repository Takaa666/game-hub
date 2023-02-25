{!!  Form::model($model, ['id' => 'form-edit','method'=>'post', 'route' => ['update-transaksi']]) !!}
@include('transaksi.form')
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="update('<?= $model->id_transaksi ?>')">update</button>
</div>
{!! Form::close() !!} 