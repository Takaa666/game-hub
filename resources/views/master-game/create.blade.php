{!!  Form::open(['id' => 'form-create','enctype' =>'multipart/form-data' , 'method'=> 'post', 'route' => ['store-game']]) !!}
@include('master-game.form')
<div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="store()">Store</button>
</div>
{!! Form::close() !!}