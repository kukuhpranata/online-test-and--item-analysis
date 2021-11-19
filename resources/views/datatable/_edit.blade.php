{!! Form::model($model, ['url' => $edit_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">event_note</i><span><b>Edit</b></span>', array('type' => 'submit', 'class' => 'btn bg-blue-grey waves-effect')) !!}
{!! Form::close() !!}