@if ($errors->any())
<ul> 
@foreach ($errors->all() as $item)
   <li>{{$item}}</li> 
@endforeach
</ul>
@endif