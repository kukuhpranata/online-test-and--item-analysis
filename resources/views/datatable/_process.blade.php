{!! Form::model($model, ['url' => $process_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">assignment</i><span>Proses</span>', array('type' => 'submit', 'class' => 'btn bg-deep-purple waves-effect')) !!}
{!! Form::close() !!}
