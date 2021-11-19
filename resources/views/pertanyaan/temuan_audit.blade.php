<div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>
                    Temuan Audit : {!!$t_temuan->temuan_audit!!} <br>
                    {{--@if($t_recommed)
                        Rekomendasi  : {!!$t_recommed->rekomendasi!!}
                    @endif--}}
                </h2>
            </div>
            @if($t_recommed)
            <div class="body">
                <a class="btn bg-light-blue waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapse_rekomendasi" aria-expanded="false"
                aria-controls="collapse_rekomendasi">
                    <b>Detail Rekomendasi</b>
                </a>
                <div class="collapse" id="collapse_rekomendasi">
                    <div class="well">
                    <div class="row">
                        <div class="header">
                            <h2>
                                Rekomendasi  : {!!$t_recommed->rekomendasi!!}
                            </h2>
                        </div>
                        <div class="body">
                            <div class="col-lg-6 col-m-6 " >
                                <dl class="dl-horizontal dl-small m-b-0 font-14">
                                    <dt>Diposisi Dirut :</dt>
                                    <dd>{!! $t_recommed->disposisi_dirut !!}</dd><br>

                                    <dt>Target Waktu Auditor :</dt>
                                    <dd>{{ Carbon\Carbon::parse($t_recommed->target_waktu_auditor)->format('d F Y') }}</dd><br>

                                    <dt>Nominal Kerugian  :</dt>
                                    <dd>{!! $t_recommed->nominal_kerugian !!}</dd><br>

                                    <dt>Jenis Temuan  :</dt>
                                    <dd>{{ $t_recommed->jenis_temuan->name_jenis_temuan }}</dd><br>
                                </dl>
                            </div>

                            
                                {{--<div class="col-lg-6 col-m-6 " >
                                    <dl class="dl-horizontal dl-small m-b-0 font-14">
                                        <dt>Tanggal Ubah Keterangan  :</dt>
                                        @if($t_act->tanggal_edit_keterangan != NULL)
                                            <dd>{!! $t_act->tanggal_edit_keterangan !!}</dd><br>
                                        @else
                                            <dd>-</dd>
                                        @endif

                                        <dt>Tanggal Ubah Lampiran  :</dt>
                                        @if($t_act->tanggal_edit_keterangan != NULL)
                                            <dd>{{ $t_act->tanggal_edit_keterangan }}</dd><br>
                                        @else
                                            <dd>-</dd>
                                        @endif
                                    </dl>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($t_act)
            <div class="body">
            <a class="btn bg-light-blue waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapse_actionplan" aria-expanded="false"
                aria-controls="collapse_actionplan">
                    <b>Detail Actionplan</b>
                </a>
                <div class="collapse" id="collapse_actionplan">
                    <div class="well">
                        <div class="row">
                            <div class="col-lg-12">
                                {{--<div class="card">--}}
                                    <div class="header">
                                        <h2>
                                            Actionplan
                                        </h2>
                                    </div>

                                    <div class="body">
                                        <div class="row">
                                            <div class="col-lg-6 col-m-6 " >
                                                <dl class="dl-horizontal dl-small m-b-0 font-14">
                                                    <dt>Actionplan :</dt>
                                                    <dd>{!! $t_act->action_plan !!}</dd><br>

                                                    <dt>Keterangan :</dt>
                                                    <dd>{!! $t_act->keterangan !!}</dd><br>

                                                    @if(Auth::user()->role_id == 1)
                                                        <dt>Tgl Ubah Lampiran  :</dt>
                                                        @if($t_act->tanggal_edit_keterangan != NULL)
                                                            <dd>{{ $t_act->tanggal_edit_keterangan }}</dd><br>
                                                        @else
                                                            <dd>-</dd>
                                                        @endif
                                                    @endif
                                                </dl>
                                            </div>

                                            <div class="col-lg-6 col-m-6 " >
                                                <dl class="dl-horizontal dl-small m-b-0 font-14">
                                                    <dt>PIC  :</dt>
                                                    <dd>{!! $t_act->pic !!}</dd><br>

                                                    <dt>Target Waktu :</dt>
                                                    {{--<dd>{!! $t_laporan->tgl_laporan !!}</dd><br>--}}
                                                    <dd>{{ Carbon\Carbon::parse($t_act->target_waktu)->format('d F Y') }}</dd><br>

                                                    @if(Auth::user()->role_id == 1)
                                                        <dt>Tgl Ubah Keterangan  :</dt>
                                                        @if($t_act->tanggal_edit_keterangan != NULL)
                                                            <dd>{!! $t_act->tanggal_edit_keterangan !!}</dd><br>
                                                        @else
                                                            <dd>-</dd>
                                                        @endif
                                                    @endif
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    {{--</div>--}}
                    </div>
                </div>
            </div>
            @endif

          {{--  @if($t_tla)
            <div class="body">
                <a class="btn bg-light-blue waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapse_tindaklanjutauditee" aria-expanded="false"
                aria-controls="collapse_tindaklanjutauditee">
                    <b>Detail Progress Action Plan</b>
                </a>
                <div class="collapse" id="collapse_tindaklanjutauditee">
                    <div class="well">
                    <div class="row">
                        <div class="header">
                            <h2>
                                Progress Action Plan
                            </h2>
                        </div>
                        <div class="body">
                            <div class="col-lg-6 col-m-6 " >
                                <dl class="dl-horizontal dl-small m-b-0 font-14">
                                    <dt>Tindak Lanjut :</dt>
                                    <dd>{!! $t_tla->tindak_lanjut_auditee !!}</dd><br>
                                </dl>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif --}}
        </div>
    </div>

    
            
        
