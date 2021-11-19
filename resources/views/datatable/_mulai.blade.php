{!! Form::model($model, ['url' => $mulai_url, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message] ) !!}
{!! Form::button('<i class="material-icons">play_arrow</i><span>Mulai Ujian</span>', array('type' => 'submit', 'class' => 'btn bg-teal waves-effect')) !!}
{!! Form::close() !!}