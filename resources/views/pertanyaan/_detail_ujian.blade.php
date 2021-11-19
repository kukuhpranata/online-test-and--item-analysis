<!DOCTYPE html>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<div class="col-lg-12">
    <div class="card">
        {{-- <div class="header">
            <h2>
            Detail Ujian
            </h2>   
        </div> --}}
        <div class="body">
        <script> 
        $(".toggle-btn").click(function(){
        $("#collapse_").collapse('Detail Ujian');
        });
        });
        </script>
        <center>
            <input type="button" class="btn toggle-btn bg-indigo waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapse_" aria-expanded="false"
            aria-controls="collapse_" value="Detail Ujian">   
            </a>
        </center>
            <div class="collapse" id="collapse_">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-6 col-m-6 " >
                            <dl class="dl-horizontal dl-small m-b-0 font-14">
                                <dt>Judul Ujian :</dt>
                                <dd>{!! $ujian->judul !!}</dd><br>

                                <dt>Pembuat Ujian :</dt>
                                <dd>{!! $ujian->user->email !!}</dd><br>

                                <dt>Tanggal Ujian  :</dt>
                                <dd>{!! $ujian->tgl_ujian !!}</dd><br>

                                <dt>Durasi :</dt>
                                <dd>{!! $ujian->durasi !!}</dd><br>

                                <dt>Jumlah Soal :</dt>
                                <dd>{!! $ujian->jumlah_soal !!}</dd><br>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
