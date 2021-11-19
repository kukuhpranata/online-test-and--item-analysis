<div class="modal-body">
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group form-float{{ $errors->has('judul') ? 'has-error': '' }} ">
                {!! Form::label('judul', 'Judul Ujian', ['class'=>'form-label']) !!}
                <div class="form-line">
                    {!! Form::text('judul', null, ['class'=>'form-control', 'required']) !!} 
                </div>
                @if ($errors->has('judul'))
                    <span class="help-block">
                        <strong>{{ $errors->first('judul') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group form-float{{ $errors->has('tgl_ujian') ? 'has-error': '' }} ">
                {!! Form::label('tgl_ujian', 'Tanggal Ujian', ['class'=>'form-label']) !!}
                <div class="form-line">
                    {!! Form::datetimeLocal('tgl_ujian', null, ['class'=>'form-control', 'required']) !!} 
                </div>
                @if ($errors->has('tgl_ujian'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tgl_ujian') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group form-float{{ $errors->has('durasi') ? 'has-error': '' }} ">
                {!! Form::label('durasi', 'Durasi Ujian', ['class'=>'form-label']) !!}
                    {!! Form::select('durasi', ['5' => '005 Menit', '10' => '010 Menit','15' => '015 Menit','20' => '020 Menit',
                                                    '25' => '025 Menit','30' => '030 Menit', '50' => '050 Menit','60' => '060 Menit','120' => '120 Menit',],null,[ 'class' => 'js-selectize', 'placeholder' => 'Pilih', 'required' ]) !!} 
                @if ($errors->has('durasi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('durasi') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group form-float{{ $errors->has('jumlah_soal') ? 'has-error': '' }} ">
                {!! Form::label('jumlah_soal', 'Jumlah Soal', ['class'=>'form-label']) !!}
                    {!! Form::select('jumlah_soal', ['10' => '10 Soal','15' => '15 Soal','20' => '20 Soal',
                                                    '25' => '25 Soal','30' => '30 Soal','40' => '40 Soal', '50' => '50 Soal',],null,[ 'class' => 'js-selectize', 'placeholder' => 'Pilih', 'required' ]) !!}
                @if ($errors->has('jumlah_soal'))
                    <span class="help-block">
                        <strong>{{ $errors->first('jumlah_soal') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>


