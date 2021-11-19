{!! Form::model($model, ['url' => $analisis_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">center_focus_strong</i><span>Analisis</span>', array('type' => 'submit', 'class' => 'btn bg-blue-grey waves-effect')) !!}
{!! Form::close() !!}