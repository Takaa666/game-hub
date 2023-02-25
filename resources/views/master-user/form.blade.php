<div class="form-group">
  <label>Username</label>
  {!! Form::text('name', null ,[ 'class' => 'form-control', 'id' => 'name']) !!}
</div>
<div class="form-group">
  <label>eMail</label>
  {!! Form::text('email', null ,[ 'class' => 'form-control', 'id' => 'email']) !!}
</div>
<div class="form-group">
  <label>Password</label>
  {!! Form::text('password', null ,[ 'class' => 'form-control', 'id' => 'passsword']) !!}
</div>
<div class="form-group">
  <label>Role</label>
  {!! Form::select('role', ['' => 'Masukan Role'] + $role, isset($model->role) ? $model->role : null, ['class' => 'form-control', 'id' => 'role']) !!}
</div>