<div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>
                    Pertanyaan
                </h2>
            </div>
    
            <div class="body">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                    
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <p><a class="btn bg-black waves-effect" data-toggle="modal" data-target="#defaultModal"> <i class="material-icons">person_add</i> <span><b>Tambah Pertanyaan</b></span></a>
                        @endif
              
                        <div class="table-responsive">
                            {!! $dataTable->table(['class' => 'table-striped', 'width' => '100%']) !!}
                            <a class="btn btn bg-primary waves-effect" href=""><i class="material-icons">arrow_back_ios</i><span><b>BACK</b></span></a>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    
@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection