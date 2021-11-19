<?php

namespace App\Helper;
use Storage;

use App\tAttachment;
use App\tTrainingAttachment;

use App\vKeshcEduHistory;
use App\vKeshcEventActivityHist;
use App\vKeshcTrainHist;
use App\vKeshcTrainOrg;
use App\vKeshcTrainTopic;
use App\vKeshcWorkHistory;
use App\vKeshcEventActivityName;

use App\vMasterPegawai;
use App\vMasterDivisi;
use Carbon\Carbon;
use App\vKeshcSto;
use App\vKeshcMasterJabatan;

class CvHelper
{
    public function getCV($nip){
        $cv = array();

        $cv["bio"] = $this->getBiodata($nip);
        $cv["edu"] = $this->getPendidikan($nip);
        $cv["training_keshc"] = $this->getTrainingKeshc($nip);
        $cv["riwayat_kerja"] = $this->getWorkHistory($nip);
        $cv["keaktifan"] = $this->getEventActivity($nip);

        return $cv;
    }


    public function getBiodata($nip)
    {
        $bio = vMasterPegawai::with('status_karyawan','status_tanggungan')->where('REGNO', $nip)->first();
        
        $data = array();
        if($bio){
            $data["nip"] = trim($bio->REGNO);
            $data["nama"] = trim($bio->NAME);
            $data["jenis_kelamin"] = trim($bio->SEX) == 'L' ? 'Pria' : 'Wanita';
            $data["agama"] = ""; // RELIGION
            $data["tempat_lahir"] = trim($bio->LOCATION);
            
            if($bio->status_tanggungan != NULL){
                $data["status"] = trim($bio->status_tanggungan->DESCMARITAL);
            }
            
            $tgl_lahir = Carbon::parse($bio->BIRTHDAY);
            $data["tgl_lahir"] = $tgl_lahir->toDateString(); 
            $data["umur"] = Carbon::now()->diffInYears($tgl_lahir) . " TAHUN";
            $data["kebangsaan"] = ""; // KEBANGSAAN
            
            $tmb = Carbon::parse($bio->TMB_DATE);
            $data["tmb"] = $tmb->toDateString();
            $data["masa_kerja"] = Carbon::now()->diffInYears($tmb) . " TAHUN";
            $data["status_pegawai"] = trim($bio->status_karyawan->DESCRIPTION) ; 
            $pendidikan = vKeshcEduHistory::where('EDUCODE', $bio->EDUCODE)->where('EDUCDDETAIL', $bio->EDUCDDETAIL)->first();
            
            if($pendidikan != NULL){
                $data["pendidikan"] = trim($pendidikan->EDUDESC);
            }else{
                $data["pendidikan"] = "";
            }
            $data["alamat"] = trim($bio->ALAMAT);
            
            $emp_sto = vKeshcSto::where('POSCODE', trim($bio->POSCODE))->first();
            $emp_pos = vKeshcMasterJabatan::where('JOBCODE', trim($bio->JOBCODE))->first();
            
            if($emp_sto == NULL){
                $data["posisi_terakhir"] = "";
            }else{
                $data["posisi_terakhir"] = trim($emp_sto->LABEL);
            }
            
            $data["jabatan_terakhir"] = trim($emp_pos->JOBDESC);

            $division = vMasterDivisi::where('DIVCODE',$bio->DIVCODE)->first();
            
            $data["divisi"] = trim($division->DESCRIPTION);
        }

        return $data;
        
    }

    public function getPendidikan($nip){
        $data = array();

        $edu_list = vKeshcEduHistory::where('REGNO', $nip)->get();
        // dd($edu_list);

        foreach($edu_list as $edu){
            $pendidikan = array();

            $pendidikan["strata"] = trim($edu->EDUDESC);
            $pendidikan["jurusan"] = $edu->JRSDESC == "*" ? '-' : trim($edu->JRSDESC);
            $pendidikan["lembaga"] = trim($edu->DESINS);

            if($edu->YEARFROM != NULL){
                $pendidikan["mulai"] = Carbon::parse($edu->YEARFROM)->toDateString();
            }else{
                $pendidikan["mulai"] = "";
            }
            
            $pendidikan["selesai"] = Carbon::parse($edu->YEARTO)->ToDateString();

            array_push($data, $pendidikan);
        }
        
        return $data;
    }

    public function getTrainingKeshc($nip){
        $data = array();

        $train_hist = vKeshcTrainHist::with('topic','organization')->where('REGNO', $nip)->orderBy('DATEFROM')->get();
        
        foreach($train_hist as $train){
            $training = array();

            if($train->topic != null){
                $training["materi"] = trim($train->topic->MATERI);
            }else{
                $training["materi"] = null;
            }
            
            if($train->organization != NULL){
                $training["lembaga"] = trim($train->organization->DESCRIPTION);
            }
            if($train->DATEFROM && $train->DATETO != NULL){
                $training["mulai"] = Carbon::parse($train->DATEFROM)->ToDateString();
                $training["selesai"] = Carbon::parse($train->DATETO)->ToDateString();
            }elseif($train->DATEFROM == NULL){
                $training["mulai"] = null;
                $training["selesai"] = Carbon::parse($train->DATETO)->ToDateString();
            }elseif($train->DATETO == NULL){
                $training["mulai"] = Carbon::parse($train->DATEFROM)->ToDateString();
                $training["selesai"] = null;
            }           

            array_push($data, $training);
        }

        return $data;
    } 

    public function getWorkHistory($nip){
        $data = array();

        $work_hist = vKeshcWorkHistory::where('REGNO',$nip)->orderBy('DATEFROM')->get();

        foreach($work_hist as $exp)
        {
            $work= array();
            $work["mulai"] = Carbon::parse($exp->DATEFROM)->toDateString();
            $work["nomor_sk"] = $exp->NOSK;
            $work["tanggal_sk"] = Carbon::parse($exp->SKDATE)->toDateString();
            $work["jabatan"] = trim($exp->POSDESC);

            array_push($data, $work);
        }
        
        return $data;
    }

    public function getEventActivity($nip){
        $data = array();

        $activity_hist = vKeshcEventActivityHist::with('org_name')->where('REGNO',$nip)->orderBy('DATEFROM')->get();
        
        foreach($activity_hist as $activity){
            $act = array();

            $act["nama_kegiatan"] = trim($activity->org_name->DESCRIPTION);
            $act["mulai"] = Carbon::parse($activity->DATEFROM)->toDateString();
            $act["selesai"] = Carbon::parse($activity->DATETO)->toDateString();
            $act["jabatan"] = trim($activity->POSITION);
            array_push($data, $act);
        }

        return $data;
    }
}