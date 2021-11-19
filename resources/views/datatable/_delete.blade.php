{{-- {!! Form::model($model, ['url' => $delete_url, 'method' => 'delete', 'class' => 'row clearfix js-sweetalert'] ) !!}  --}}
{!! Form::model($model, ['url' => $delete_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message] ) !!} 
{{-- {!! Form::button('<i class="material-icons">delete</i><span>Delete</span>', array('class' => 'btn bg-red waves-effect', 'data-type' => 'confirm')) !!} --}}
{!! Form::button('<i class="material-icons">delete</i><span><b>Hapus</b></span>', array('type' => 'submit', 'class' => 'btn bg-red waves-effect')) !!}
{!! Form::close() !!}
