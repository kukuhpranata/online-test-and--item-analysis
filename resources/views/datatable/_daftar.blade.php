{!! Form::model($model, ['url' => $daftar_url, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message] ) !!}
{!! Form::button('<i class="material-icons">assessment</i><span>Daftar</span>', array('type' => 'submit', 'class' => 'btn bg-indigo waves-effect')) !!}
{!! Form::close() !!}
