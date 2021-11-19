{!! Form::model($model, ['url' => $show_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">pageview</i><span>Show</span>', array('type' => 'submit', 'class' => 'btn bg-blue waves-effect')) !!}
{!! Form::close() !!}
