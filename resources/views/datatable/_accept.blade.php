{!! Form::model($model, ['url' => $accept_url, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message] ) !!}
{!! Form::button('<i class="material-icons">note_add</i><span>Accept</span>', array('type' => 'submit', 'class' => 'btn bg-deep-purple waves-effect')) !!}
{!! Form::close() !!}
