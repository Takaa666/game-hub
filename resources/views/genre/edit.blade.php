{!!  Form::model($model, ['id' => 'form-edit','method'=>'post', 'route' => ['update-platform']]) !!}
@include('genre.form')
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="update('<?= $model->id_genre ?>')">update</button>
</div>
{!! Form::close() !!} 