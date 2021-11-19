{!! Form::model($model, ['url' => $enrolled_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">list</i><span>Enrolled User</span>', array('type' => 'submit', 'class' => 'btn bg-blue-grey waves-effect')) !!}
{!! Form::close() !!}