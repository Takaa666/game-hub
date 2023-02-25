{!!  Form::model($model, ['id' => 'form-edit','method'=>'post', 'route' => ['update-display']]) !!}
@include('display.form')
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="update('<?= $model->id_display ?>')">Update</button>
</div>
{!! Form::close() !!}