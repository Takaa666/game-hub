<div class="form-group">
  <label>Nama Game</label>
  {!! Form::text('nama_game', null ,[ 'class' => 'form-control', 'id' => 'nama_game']) !!}
</div>
<div class="form-group">
  <label>Genre</label>
  {!! Form::select('id_genre', ['' => 'Pilih'] + $genre->toArray(), isset($model->id_genre) ? $model->id_genre : null, ['class' => 'form-control', 'id' => 'nama_genre']) !!}
</div>
<div class="form-group">
  <label>Deskripsi</label>
  {!! Form::text('deskripsi', null ,[ 'class' => 'form-control', 'id' => 'deskripsi']) !!}
</div>
<div class="form-group">
  <label>Developer</label>
  {!! Form::select('id_developer', ['' => 'Pilih'] + $developer->toArray(), isset($model->id_developer) ? $model->id_developer : null, ['class' => 'form-control', 'id' => 'nama_perusahaan']) !!}
</div>
<div class="form-group">
  <label>Platform</label>
  {!! Form::select('id_platform', ['' => 'Pilih'] + $platform->toArray(), isset($model->id_platform) ? $model->id_platform : null, ['class' => 'form-control', 'id' => 'jenis_plaform']) !!}
</div>
<div class="form-group">
  <label>Harga</label>
  {!! Form::text('harga', null ,[ 'class' => 'form-control', 'id' => 'harga']) !!}
</div>
<div class="form-group">
  <label>Diskon</label>
  {!! Form::text('diskon', null ,[ 'class' => 'form-control', 'id' => 'diskon']) !!}
</div>
<div class="form-group">
  <label>Status</label>
  {!! Form::select('status', ['' => 'Masukan Status'] + $status, isset($model->status) ? $model->status : null, ['class' => 'form-control', 'id' => 'status']) !!}
</div>
<div class="form-group">
  <label>Gambar Sampul</label>
  {!! Form::file('gambar_sampul', ['class' => 'form-control','id' => 'gambar_sampul']) !!}
</div>
<div class="form-group">
  <label>Gambar Detail</label>
  {!! Form::file('gambar_detail', ['class' => 'form-control','id'=> 'gambar_detail']) !!}
</div>
