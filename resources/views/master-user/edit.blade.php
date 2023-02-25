{!!  Form::model($model, ['id' => 'form-edit','method'=>'post', 'route' => ['update-user']]) !!}
@include('master-user.form')
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="update('<?= $model->id ?>')">update</button>
</div>
{!! Form::close() !!} 