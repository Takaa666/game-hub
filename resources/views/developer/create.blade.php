{!!  Form::open(['id' => 'form-create', 'method'=> 'post', 'route' => ['store-developer']]) !!}
@include('developer.form')
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="store()">Store</button>
</div>
{!! Form::close() !!}