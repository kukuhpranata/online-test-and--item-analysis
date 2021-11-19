{!! Form::model($model, ['url' => $pdf_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="material-icons">picture_as_pdf</i><span>Lihat</span>', array('type' => 'submit', 'class' => 'btn bg-red waves-effect')) !!}
{!! Form::close() !!}
