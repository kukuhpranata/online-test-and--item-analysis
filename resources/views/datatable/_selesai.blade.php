{!! Form::model($model, ['url' => $selesai_url, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message] ) !!}
{!! Form::button('<i class="material-icons">stop</i><span>Selesai Ujian</span>', array('type' => 'submit', 'class' => 'btn bg-indigo waves-effect')) !!}
{!! Form::close() !!}