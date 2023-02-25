
@if (auth()->user()->role=='admin')
<div class="form-group">
  <label>Status</label>
  {!! Form::select('status', ['' => 'Masukan Status'] + $status, isset($model->status) ? $model->status : null, ['class' => 'form-control', 'id' => 'status']) !!}
</div>
@else
<div class="form-group">
  <label class="text-white mb-3 mt-3"></label>
  {!! Form::hidden('id_game', null, ['class' => 'form-control', 'id' => 'id_game']) !!}
</div>
<div class="form-group">
  <label class="text-white mb-3 mt-3">Nama Game</label>
  {!! Form::text('nama_game', null, ['class' => 'form-control', 'id' => 'nama_game', 'readonly']) !!}
</div>
<div class="form-group">
  <label class="text-white mb-3 mt-3">Harga</label>
  {!! Form::text('harga', null, ['class' => 'form-control', 'id' => 'harga', 'readonly']) !!}
</div>
<div class="form-group">
  <label class="text-white mb-3 mt-3">Diskon</label>
  {!! Form::text('diskon', null, ['class' => 'form-control', 'id' => 'lastspin', 'readonly']) !!}
  <label class="text-white">
    <input type="checkbox" id="lastspin">Gunakan Diskon</label>
</div>
<div class="form-group">
  <label class="text-white mb-3 mt-3">Total Harga</label>
  {!! Form::text('total', null, ['class' => 'form-control', 'id' => 'total', 'readonly']) !!}
</div>
<div class="form-group">
  <label class="text-white mb-3 mt-3">Bukti Transfer</label>
  {!! Form::file('bukti_transfer', ['class' => 'form-control','id' => 'bukti_transfer']) !!}
</div>
@endif
