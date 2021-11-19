{!! Form::model($model, ['url' => $kirim_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">mail</i><span><b>Kirim Notif</b></span>', array('type' => 'submit', 'class' => 'btn bg-green waves-effect')) !!}
{!! Form::close() !!}


