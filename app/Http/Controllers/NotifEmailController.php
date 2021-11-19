<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NotifEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\tLaporanMonitoring;
use App\tRekomendasi;
use App\tTemuanAudit;
use App\tTindakLanjut;
use App\tTindakLanjutAuditee;
use App\tActionPlan;
use App\User;
use App\DataTables\Laporan\LaporanMonitoringDataTable;
use App\DataTables\Laporan\tTemuanAuditDataTable;
use App\DataTables\tTrainingEmployeeDataTable;
use App\mObjAudit;
use App\mBagUnit;
use Excel;
use Session;
use Auth;
use App\DataTables\Laporan\tTindakLanjutAuditeeDataTable;
use App\tRiwayatNotifEmail;
use Carbon;
use App\DataTables\Laporan\tTindakLanjutDataTable;


class NotifEmailController extends Controller
{
    public function index($tla_id){
		//$t_follow = tTindakLanjut::with('tindak_lanjut_auditee')->find($tla_id);
		
        //sini
        $t_tla = tTindakLanjutAuditee::with('action_plan')->find($tla_id);
        //sampai sini
        $t_act = tActionPlan::with('rekomendasi')->find($t_tla->action_plan_id);
        
        //$t_follow = tTindakLanjut::with('action_plan')->find($foll_id);

        //$t_act = tActionPlan::with('rekomendasi')->find($t_follow->action_plan_id);

        $t_rekomm = tRekomendasi::with('jenis_temuan')->find($t_act->rekomendasi_id);

        $t_temuan = tTemuanAudit::with('laporan_monitoring')->find($t_rekomm->temuan_audit_id);

        $t_lap = tLaporanMonitoring::find($t_temuan->laporan_monitoring_id);
		
	
		///	$t_lap = tLaporanMonitoring::with('objek_audit','bag_unit','jenis_penugasan','jenis_audit')->find($lap_id);
		//$a=User::where('role_id', 3)->where('obj_audit_id',1)->get();
		$t_obj = mObjAudit::with('code_objaudit', 'name_objaudit')->find($t_lap->obj_audit_id);
		//$t_lap = tLaporanMonitoring::with('objek_audit','bag_unit','jenis_penugasan','jenis_audit')->find($laporan_id);
		//dd($t_obj);
	
		$t_auditee = User::with('useremail', 'objek_audit', 'bagian_unit', 'role', 'pas')->where('role_id', 3)->
		where('obj_audit_id',$t_lap->obj_audit_id)->get();
		//$t_auditee=json_decode( json_encode($t_auditee), true);
		//$mail=explode(',', $this->$t_auditee->email);
		
		//$mail=$t_auditee->email;
		$b=$t_lap->id;
		//dd( $t_lap, $t_obj, $t_auditee, $b);
		$now = Carbon\Carbon::now();
//dd($now);


		foreach($t_auditee as $auditee){
			$mail=$auditee->email;
			Mail::to($auditee->email)->send(new NotifEmail($auditee));
			tRiwayatNotifEmail::create([
				'email_tujuan' => $mail,
				'laporan_monitoring_id' => $t_lap->id,
			   ]);

		}
		$t_lap->update([
			'riwayat_notif_email' => $now,
	   
		]);
		Session::flash("flash_notification",[
            "level" => "green",
            "message" => "Notifikasi Telah Dikirim"
		]);
		

		

 
		//return "Email telah dikirim";
		return redirect()->route('index.tindak_lanjut_auditee', [$t_act->id]);
	}
}
