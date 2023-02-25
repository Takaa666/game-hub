<table width="100%" >
  <tr>
      <th>Nama Game</th>
      <td>{!! $model->game_display !!}</td>
  </tr>
  <tr>
      <th>Deskripsi</th>
      <td>{!! $model->deskripsi !!}</td>
  </tr>
  <tr>
      <th >Gambar Display</th>
      <td > <img src="{{asset('assets')}}\images\{{$model->gambar_display}}" alt=""></td>
  </tr>
  <tr>
    <tr>
        <th >Gambar Detail</th>
        <td > <img src="{{asset('assets')}}\images\{{$model->gambar_detail}}" alt=""></td>
    </tr>
    <tr>
      <th>Platform</th>
      <td>{!! $model->jenis_platform !!}</td>
  </tr>
  <tr>
      <th>Genre</th>
      <td>{!! $model->nama_genre !!}</td>
  </tr>
  <tr>
      <th>Developer</th>
      <td>{!! $model->nama_perusahaan !!}</td>
  </tr>
  <tr>
      <th>Harga</th>
      <td>{!! $model->harga_display !!}</td>
  </tr>
</table>