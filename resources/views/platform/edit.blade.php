{!!  Form::model($model, ['id' => 'form-edit','method'=>'post', 'route' => ['update-platform']]) !!}
@include('platform.form')
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="update('<?= $model->id_platform ?>')">update</button>
</div>
{!! Form::close() !!} 