{!!  Form::model($model, ['id' => 'form-edit','method'=>'post', 'route' => ['update-game']]) !!}
@include('master-game.form')
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="update('<?= $model->id_game ?>')">Update</button>
</div>
{!! Form::close() !!} 