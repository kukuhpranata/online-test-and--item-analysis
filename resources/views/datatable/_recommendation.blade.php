{!! Form::model($model, ['url' => $recommendation_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">post_add</i><span><b>Rekomendasi</b></span>', array('type' => 'submit', 'class' => 'btn bg-green waves-effect')) !!}
{!! Form::close() !!}