{!! Form::model($model, ['url' => $detail_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">assessment</i><span>Detail</span>', array('type' => 'submit', 'class' => 'btn bg-teal waves-effect')) !!}
{!! Form::close() !!}