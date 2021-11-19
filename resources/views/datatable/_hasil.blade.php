{!! Form::model($model, ['url' => $hasil_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">check_circle</i><span>Lihat Hasil</span>', array('type' => 'submit', 'class' => 'btn bg-indigo waves-effect')) !!}
{!! Form::close() !!}