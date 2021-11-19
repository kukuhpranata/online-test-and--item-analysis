{!! Form::model($model, ['url' => $add_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">add</i><span>Add</span>', array('type' => 'submit', 'class' => 'btn bg-green waves-effect')) !!}
{!! Form::close() !!}
