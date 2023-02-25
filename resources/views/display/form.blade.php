<div class="form-group">
  <label>Game</label>
  {!! Form::select('id_game', ['' => 'Pilih'] + $game->toArray(), isset($model->id_game) ? $model->id_game : null, ['class' => 'form-control', 'id' => 'id_game']) !!}
</div>

<div>
  <label>Gambar Display</label>
  {!! Form::file('gambar_display', ['class' => 'form-control','id' => 'gambar_display']) !!}
</div>