<table width="100%" >
  <tr>
      <th>Nama Game</th>
      <td>{!! $model->nama_game !!}</td>
  </tr>
  <tr>
    <th>Email</th>
    <td>{!! $model->email !!}</td>
</tr>
<tr>
  <th>Harga</th>
  <td>Rp. {!! $model->harga !!}</td>
</tr>
<tr>
  <th>Diskon</th>
  <td>{!! $model->diskon !!}%</td>
</tr>
<tr>
  <th>Total</th>
  <td>Rp. {!! $model->total !!}</td>
</tr>
<tr>
  <th>Bukti Transfer</th>
  <td> <img src="{{asset('assets')}}\images\{{$model->bukti_transfer}}" width="200px" alt=""></td>
</tr>
</table>