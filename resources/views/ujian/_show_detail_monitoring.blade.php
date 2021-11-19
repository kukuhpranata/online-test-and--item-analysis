<!DOCTYPE html>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<div class="col-lg-12">
    <div class="card">
        <div class="header">
            <h2>
            Laporan Monitoring {!! $t_laporan->jenis_audit->name_jenis_audit !!} {!! $t_laporan->objek_audit->name_obj_audit !!} :
                {{--<small>Click the buttons below to show and hide another element via class changes. You can use a link with the <code>href</code> attribute, or a button with the <code>data-target</code> attribute. In both cases, the <code>data-toggle="collapse"</code> is required.</small>--}}
            </h2>
            
        </div>
        <div class="body">
        <script> 
        $(".toggle-btn").click(function(){
        $("#myCollapsible").collapse('Detail Laporan Monitoring');
        });
        });
        </script>
            <input type="button" class="btn toggle-btn bg-light-blue waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapse_laporan_monitoring" aria-expanded="false"
            aria-controls="collapse_laporan_monitoring" value="Detail Laporan Monitoring">   
            </a>
            <div class="collapse" id="collapse_laporan_monitoring">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-6 col-m-6 " >
                            <dl class="dl-horizontal dl-small m-b-0 font-14">
                                <dt>Objek Audit :</dt>
                                <dd>{!! $t_laporan->objek_audit->name_obj_audit !!}</dd><br>

                                <dt>Jenis Audit  :</dt>
                                <dd>{!! $t_laporan->jenis_audit->name_jenis_audit !!}</dd><br>

                                <dt>Periode Audit  :</dt>
                                {{--<dd>{!! $t_laporan->period_audit !!}</dd><br>--}}
                                <dd>{{ Carbon\Carbon::parse($t_laporan->period_audit)->format('d F Y') }}</dd><br>

                                <dt>Tanggal LHA Dirut  :</dt>
                                {{--<dd>{!! $t_laporan->tgl_LHA_dirut !!}</dd><br>--}}
                                <dd>{{ Carbon\Carbon::parse($t_laporan->tgl_LHA_dirut)->format('d F Y') }}</dd><br>
                            </dl>
                        </div>

                        <div class="col-lg-6 col-m-6 " >
                            <dl class="dl-horizontal dl-small m-b-0 font-14">
                                <dt>Nomor Laporan :</dt>
                                <dd>{!! $t_laporan->no_laporan !!}</dd><br>

                                <dt>Tanggal Laporan :</dt>
                                {{--<dd>{!! $t_laporan->tgl_laporan !!}</dd><br>--}}
                                <dd>{{ Carbon\Carbon::parse($t_laporan->tgl_laporan)->format('d F Y') }}</dd><br>

                                <dt>Tanggal Terbit Laporan :</dt>
                                {{--<dd>{!! $t_laporan->tgl_terbit_laporan !!}</dd><br>--}}
                                <dd>{{ Carbon\Carbon::parse($t_laporan->tgl_terbit_laporan)->format('d F Y') }}</dd><br>

                                <dt>Terakhir diubah SPI :</dt>
                                @if($t_laporan->tgl_edit_spi != NULL)
                                    {{--<dd>{!! $t_laporan->tgl_edit_spi !!}</dd><br>--}}
                                    <dd>{{ Carbon\Carbon::parse($t_laporan->tgl_edit_spi)->format('d F Y') }}</dd><br>
                                @else
                                    <dd>Belum ada perubahan</dd><br>
                                @endif

                                <dt>Terakhir diubah Auditee :</dt>
                                @if($t_laporan->tgl_edit_spi != NULL)
                                    {{--<dd>{!! $t_laporan->tgl_edit_auditee !!}</dd><br>--}}
                                    <dd>{{ Carbon\Carbon::parse($t_laporan->tgl_edit_auditee)->format('d F Y') }}</dd><br>
                                @else
                                    <dd>Belum ada perubahan</dd><br>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
