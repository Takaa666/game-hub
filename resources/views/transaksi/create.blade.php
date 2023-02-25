@extends('layout.main')
@section('content')
{!!  Form::model($model,['id' => 'form-create','enctype' =>'multipart/form-data', 'method'=> 'post', 'route' => ['store-transaksi']]) !!}
@include('transaksi.form')
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Store</button>
</div>
{!! Form::close() !!}
@endsection