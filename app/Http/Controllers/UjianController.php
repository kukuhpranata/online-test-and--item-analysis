<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mUjian;
use App\User;
use App\mPertanyaan;
use App\mOpsi;
use App\mJawaban;
use App\mEnrollUjian;
use App\DataTables\UjianDataTable;
use App\DataTables\AnalisisDataTable;
use App\DataTables\EnrolledAdminDataTable;
use App\DataTables\UjianTerdaftarDataTable;
use Auth;
Use Session;
use Carbon;
use Illuminate\Support\Facades\Input;


class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UjianDataTable $dataTable)
    {
        return $dataTable->render('ujian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = 0 ;
        $data = User::all();
        $editdata = mUjian::find($id);
        return view('ujian.create',compact('data','editdata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'judul' => 'required',
            'tgl_ujian' => 'required',
            'durasi' => 'required',
            'jumlah_soal' => 'required',

        ]);
        
        $end = Carbon\Carbon::parse($request->tgl_ujian)->addMinutes($request->durasi);
        //dd($end);


        $ujian = mUjian::create([
            'judul' => $request->judul,
            'tgl_ujian' => $request->tgl_ujian,
            'durasi' => $request->durasi,
            'tgl_ujian_end' => $end,
            'jumlah_soal' => $request->jumlah_soal,
            'status' => 1,
            'user_id' => Auth::user()->id,

        ]);

       // $ujian_id->$ujian->id;
        //dd($ujian->id);

        Session::flash("flash_notification",[
            "level" => "green",
            "message" => "Berhasil Menyimpan Data Ujian dari $ujian->judul"
        ]);

        return redirect()->route('ujian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ujian = mUjian::find($id);

        return view('ujian.edit')->with(compact('ujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'judul' => 'required',
            'tgl_ujian' => 'required',
            'durasi' => 'required',
            'jumlah_soal' => 'required',

        ]);
        
        $ujian = mUjian::find($id);
        $end = Carbon\Carbon::parse($request->tgl_ujian)->addMinutes($request->durasi);

        $ujian->update([
            'judul' => $request->judul,
            'tgl_ujian' => $request->tgl_ujian,
            'tgl_ujian_end' => $end,
            'durasi' => $request->durasi,
            'jumlah_soal' => $request->jumlah_soal,
            'status' => 1,
            'user_id' => Auth::user()->id,

        ]);

        Session::flash("flash_notification",[
            "level" => "green",
            "message" => "Berhasil Mengubah Data Ujian dari $ujian->judul"
        ]);

        return redirect()->route('ujian.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ujian = mUjian::find($id);
        
        mUjian::destroy($id);

        Session::flash("flash_notification",[
                "level" => "green",
                "message" => "Berhasil Menghapus Data Ujian = $ujian->judul"
        ]);

       return redirect()->route("ujian.index");
    }



    public function viewUjian($ujian_id)
    {
        $ujian = mUjian::where('id',$ujian_id)->first();
        $pertanyaan = mPertanyaan::with('ujian')->where('ujian_id', $ujian ->id)->get();

        $waktu_refresh = Carbon\Carbon::parse($ujian->tgl_ujian_end)->addSeconds(30);
        // dd($waktu_refresh);

        $enrolled = mEnrollUjian::where('ujian_id', $ujian->id)->where('user_id', Auth::user()->id)->first();

        if(Auth::user()->role_id == 2){
            return view('view_ujian.index')->with(compact('ujian', 'pertanyaan', 'waktu_refresh', 'enrolled'));
        }
        else{
            return view('view_ujian.index_admin')->with(compact('ujian', 'pertanyaan', 'waktu_refresh', 'enrolled'));
        }
        
    }


    public function storeJawaban(UjianDataTable $dataTable, Request $request, $id)
    {
        $user = Auth::user();
        $ujian = mUjian::where('id', $id)->first();
        $pertanyaan = mPertanyaan::with('ujian')->where('ujian_id', $ujian ->id)->get();

        foreach($pertanyaan as $key=> $pertanyaan){
            $new_jawaban = mJawaban::first();
        
            $new_jawaban = new mJawaban();
            $new_jawaban->user_id = $user->id;
            $new_jawaban->ujian_id = $ujian->id;
            $new_jawaban->pertanyaan_id = $pertanyaan->id;
            $new_jawaban->jawaban_user = Input::get('opsi'.$pertanyaan->id);
            if(Input::get('opsi'.$pertanyaan->id) == $pertanyaan->jawaban){
                $new_jawaban->poin = 1;
            }
            else{
                $new_jawaban->poin = 0;
            }
            $new_jawaban->save();
        }

        $usr_ans = mJawaban::where('ujian_id', $id)->
                    where('user_id', $user->id)->where('poin', 1.00)
                    ->count();
        $new_nilaikahir = mEnrollUjian::where('ujian_id', $id)->where('user_id', $user->id)->first();
        $new_nilaikahir->update([
            'nilai_akhir' => $usr_ans,
            'status_kehadiran' => 2,
        ]);

        $ujian = mUjian::where('id',$id)->first();
        $pertanyaan = mPertanyaan::with('ujian')->where('ujian_id', $ujian ->id)->get();

        $waktu_refresh = Carbon\Carbon::parse($ujian->tgl_ujian_end)->addMinutes(2);

        $enrolled = mEnrollUjian::where('ujian_id', $ujian->id)->where('user_id', Auth::user()->id)->first();

        return view('view_ujian.index')->with(compact('ujian', 'pertanyaan', 'waktu_refresh', 'enrolled'));
    }



    public function updateDaftar(UjianDataTable $dataTable, $id){
        $ujian = mUjian::where('id', $id)->first();
        $ujian_id = $ujian->id;
        $user = Auth::user() ->id;

       // dd($ujian_id, $user);
        $enrolled = mEnrollUjian::where([
            ['user_id', $user],
            ['ujian_id', $ujian_id],
        ])->first();

       // dd($enrolled);

        if($enrolled == null){
            $daftar = mEnrollUjian::create([
                'user_id' => Auth::user()->id,
                'ujian_id' => $ujian->id,
                'status_kehadiran' => 1,
                'status_daftar' => 1,
                ]);
    
            Session::flash("flash_notification",[
                "level" => "green",
                "message" => "Berhasil Mendaftar $ujian->judul"
            ]);

            return $dataTable->render('home');
        }
        else{

            return $dataTable->render('home');
        }


    }

    public function mulaiUjian(UjianDataTable $dataTable, $id)
    {

        

        $ujian = mUjian::where('id', $id)->first();  
        $ujian->update([
            'status' => 2,
        ]);

        return $dataTable->render('ujian.index');
    }

    public function selesaiUjian(UjianDataTable $dataTable, $id)
    {
        $ujian = mUjian::where('id', $id)->first();
        $ujian->update([
            'status' => 3,
        ]);

        $tidak_hadir = mEnrollUjian::where('ujian_id', $id)->where('status_kehadiran', 1)->get();
        foreach($tidak_hadir as $key => $tidak_hadir){
            $tidak_hadir->update([
                'nilai_akhir' => 0,
                'status_kehadiran' => 3,
            ]);
        }


        return $dataTable->render('ujian.index');
    }

    public function analisis(UjianDataTable $dataTable, $id)
    {
        //Derajat Kesukaran
        $pertanyaan = mPertanyaan::where('ujian_id', $id)->get();
        $jawaban =[];

        foreach($pertanyaan as $key=> $pertanyaan){
            array_push($jawaban, $pertanyaan->jawaban);

        }

        $user_answer = [];
        foreach($pertanyaan as $key=> $pertanyaan){
            $usr_ans = mJawaban::where('ujian_id', $id)->
            where('pertanyaan_id', $pertanyaan->id)
            ->first();
            array_push($user_answer, $usr_ans->jawaban);
        }


        $a =[];
        foreach($pertanyaan as $key=> $pertanyaan){
            array_push($a, Input::get('opsi'.$pertanyaan->id));
        }
       // dd($a);
        // $jmlh_benar = 


        // $b = 
        // $js = 

        return $dataTable->render('ujian.index');
    }


    public function hitungAnalisis(AnalisisDataTable $dataTable, $id){
        //Derajat Kesukaran
        $usr = mEnrollUjian::where('ujian_id', $id)->get();
        $pertanyaan = mPertanyaan::where('ujian_id', $id)->get();
        $pert=[];
        foreach($pertanyaan as $key=> $pertanyaan){
            array_push($pert, $pertanyaan->id);
        }

        $benar =[];
        if (is_array($pert) || is_object($pert)){
            foreach($pert as $key=> $pert){
                        $usr_ans = mJawaban::where('ujian_id', $id)->
                        where('pertanyaan_id', $pert)->where('poin', 1.00)
                        ->count();
                        array_push($benar, $usr_ans);
            }
        }
        //dd($benar);

        $p_array=[];
        $jumlah_peserta = mEnrollUjian::where('ujian_id', $id)->count();
        if (is_array($benar) || is_object($benar)){
            foreach($benar as $key=> $benar){
                $p = $benar/$jumlah_peserta;
                array_push($p_array, $p);
            }
        }
        
        //dd($p_array);

        //Daya Beda
        $jumlah_usr = mEnrollUjian::where('ujian_id', $id)->count();
        $jumlah_atass = round($jumlah_usr/2);
        $jumlah_atas = intval($jumlah_atass);
    
        $usr_atas = mEnrollUjian::where('ujian_id', $id)->orderBy('nilai_akhir', 'DSC')->limit($jumlah_atas)->get();
        $usr_atas_arr = [];
        //dd($jumlah_atas, $usr_atas);
        foreach($usr_atas as $key=> $usr_atas){
            array_push($usr_atas_arr, $usr_atas->user_id);
        }
        //dd($usr_atas_arr);
        

        $pertanyaan_dba = mPertanyaan::where('ujian_id', $id)->get();
        $pert_dba=[];
        foreach($pertanyaan_dba as $key=> $pertanyaan_dba){
            array_push($pert_dba, $pertanyaan_dba->id);
        }

        $benar_dba =[];
        if (is_array($pert_dba) || is_object($pert_dba)){
            foreach($pert_dba as $key=> $pert_dba){
                        $usr_ans_dba = mJawaban::where('ujian_id', $id)->whereIn('user_id', $usr_atas_arr)
                        ->where('pertanyaan_id', $pert_dba)->where('poin', 1.00)
                        ->count();
                        array_push($benar_dba, $usr_ans_dba);
            }
        }

        $p_array_dba=[];
        if (is_array($benar_dba) || is_object($benar_dba)){
            foreach($benar_dba as $key=> $benar_dba){
                $p_atas = $benar_dba/$jumlah_atas;
                array_push($p_array_dba, $p_atas);
            }
        }

        //db bawah
        $jumlah_usr = mEnrollUjian::where('ujian_id', $id)->count();
        $jumlah_bawah = floor($jumlah_usr/2);
    
        $usr_bawah = mEnrollUjian::where('ujian_id', $id)->whereNotIn('user_id', $usr_atas_arr)->get();
        //dd($usr_atas_arr, $usr_bawah);
        $usr_bawah_arr = [];
        foreach($usr_bawah as $key=> $usr_bawah){
            array_push($usr_bawah_arr, $usr_bawah->user_id);
        }
       // dd($usr_bawah_arr);
        

        $pertanyaan_dbb = mPertanyaan::where('ujian_id', $id)->get();
        $pert_dbb=[];
        foreach($pertanyaan_dbb as $key=> $pertanyaan_dbb){
            array_push($pert_dbb, $pertanyaan_dbb->id);
        }

        $benar_dbb =[];
        if (is_array($pert_dbb) || is_object($pert_dbb)){
            foreach($pert_dbb as $key=> $pert_dbb){
                        $usr_ans_dbb = mJawaban::where('ujian_id', $id)->whereNotIn('user_id', $usr_atas_arr)
                        ->where('pertanyaan_id', $pert_dbb)->where('poin', 1.00)
                        ->count();
                        array_push($benar_dbb, $usr_ans_dbb);
            }
        }

        //dd($usr_atas_arr);

        $p_array_dbb=[];
        if (is_array($benar_dbb) || is_object($benar_dbb)){
            foreach($benar_dbb as $key=> $benar_dbb){
                $p_bawah = $benar_dbb/$jumlah_bawah;
                array_push($p_array_dbb, $p_bawah);
            }
        }
        //dd($p_array_dba, $p_array_dbb);

        $subtracted = array_map(function ($x, $y) { return $x-$y; } , $p_array_dba, $p_array_dbb);
        $d     = array_combine(array_keys($p_array_dba), $subtracted);
        //dd($d);

        //Validitas
        //SD
        $nilai_akhir = mEnrollUjian::where('ujian_id', $id)->get();
        $xt=[];
        foreach($nilai_akhir as $key=> $nilai_akhir){
            array_push($xt, $nilai_akhir->nilai_akhir);
        }

        function Stand_Deviation($arr){
            $num_of_elements = count($arr);
            $variance = 0.0;
            $average = array_sum($arr)/$num_of_elements;    
            foreach($arr as $i)
            {
                $variance += pow(($i - $average), 2);
            }
            return (float)sqrt($variance/$num_of_elements);
        }

        $sd = Stand_Deviation($xt);

        //Mp
        $pertanyaan_sd = mPertanyaan::where('ujian_id', $id)->get();
        $pert_sd=[];
        foreach($pertanyaan_sd as $key=> $pertanyaan_sd){
            array_push($pert_sd, $pertanyaan_sd->id);
        }

        $benar_sd =[];
        if (is_array($pert_sd) || is_object($pert_sd)){
            foreach($pert_sd as $key=> $pert_sd){
                        $usr_ans_sd = mJawaban::where('ujian_id', $id)->
                        where('pertanyaan_id', $pert_sd)->where('poin', 1.00)
                        ->count();
                        array_push($benar_sd, $usr_ans_sd);
            }
        }


        $pertanyaan_sd = mPertanyaan::where('ujian_id', $id)->get();
        $pert_sd=[];
        foreach($pertanyaan_sd as $key=> $pertanyaan_sd){
            array_push($pert_sd, $pertanyaan_sd->id);
        }

        $benar_sd_id =[];
        if (is_array($pert_sd) || is_object($pert_sd)){
            foreach($pert_sd as $key=> $pert_sd){
                        $usr_ans_sd = mJawaban::where('ujian_id', $id)->
                        where('pertanyaan_id', $pert_sd)->where('poin', 1.00)
                        ->get();
                        array_push($benar_sd_id, $usr_ans_sd);
            }
        }

        $pertanyaan_sd = mPertanyaan::where('ujian_id', $id)->get();
        $pert_sd=[];
        $a=0;
        foreach($pertanyaan_sd as $key=> $pertanyaan_sd){
            array_push($pert_sd, $a++);
        }

        $jmlh_yang_benar =[];
        $pre_mt_arr=[];
        if (is_array($pert_sd) || is_object($pert_sd)){
            foreach($pert_sd as $key=> $pert_sd){
                        $x=0;
                        while($x < $benar_sd[$key]) {
                            $pre_mt = mEnrollUjian::select('nilai_akhir')->where('ujian_id', $id)->where('user_id', $benar_sd_id[$pert_sd][$x]->user_id)
                            ->get();
                            array_push($pre_mt_arr, $pre_mt[0]->nilai_akhir);
                            $x = $x +1;
                        }

                        $y = array_sum($pre_mt_arr);
                        array_push($jmlh_yang_benar, $y);
                        $pre_mt_arr=[];

            }
        }

        $mp =[];
        if (is_array($jmlh_yang_benar) || is_object($jmlh_yang_benar)){
            foreach($jmlh_yang_benar as $key=> $jmlh_yang_benar){
                if($benar_sd[$key] > 0){
                    array_push($mp, $jmlh_yang_benar/($benar_sd[$key]));
                }
                else{
                    array_push($mp, 0);
                }
            }
        }
        //dd($mp);

        //Mt
        $pre_mt = mEnrollUjian::where('ujian_id', $id)->sum('nilai_akhir');
        $mt = $pre_mt/mEnrollUjian::where('ujian_id', $id)->count();
        //dd($mp,$mt);
        
        //p & q
        $p =[];
        $jmlah = mEnrollUjian::where('ujian_id', $id)->count();
        if (is_array($benar_sd) || is_object($benar_sd)){
            foreach($benar_sd as $key=> $benar_sd){
                array_push($p, $benar_sd/$jmlah);
            }
        }
        $p2 = $p;
        $q=[];
        $p3 = $p;

        if (is_array($p2) || is_object($p2)){
            foreach($p2 as $key=> $p2){
                array_push($q, 1-$p2);
            }
        }
        //dd($p);

        $pertanyaan = mPertanyaan::where('ujian_id', $id)->get();
        $ypbi=[];
        if (is_array($pertanyaan) || is_object($pertanyaan)){
            foreach($pertanyaan as $key=> $pertanyaan){
                $persamaan1=($mp[$key]-$mt)/$sd;
                $persamaan2= $p[$key]/(1-$p[$key]);
                // $persamaan2= $p[$key]*(1-$p[$key]);
                $persamaan3= sqrt($persamaan2);
                array_push($ypbi, $persamaan1*$persamaan3);
            }
        }

        //Reliabilitas KR20
        $pq= [];
        if (is_array($p3) || is_object($p3)){
            foreach($p3 as $key=> $p3){
                array_push($pq, $p3*$q[$key]);
            }
        }
        $s_pq = array_sum($pq);

        $persamaan1 =(mPertanyaan::where('ujian_id', $id)->count()/(mPertanyaan::where('ujian_id', $id)->count() -1));
        $persamaan2 = ($sd*$sd)-$s_pq;
        $persamaan3 = $persamaan2/($sd*$sd);
        $k20 = $persamaan1*$persamaan3;

        //Reliabilitas KR21
        $persamaan1 =(mPertanyaan::where('ujian_id', $id)->count()/(mPertanyaan::where('ujian_id', $id)->count() -1));
        $persamaan2 = $mt*(mPertanyaan::where('ujian_id', $id)->count()- $mt);
        $persamaan3 = mPertanyaan::where('ujian_id', $id)->count()*($sd*$sd);
        $persamaan4 = 1 - ($persamaan2/$persamaan3);
        $k21 = $persamaan1*$persamaan4;
        // dd($ypbi, $k20, $k21, $p_array, $d, $sd);

        //Efektivitas Pengecoh
        $pertanyaan = mPertanyaan::where('ujian_id', $id)->get();
        $jumlah_c = mEnrollUjian::where('ujian_id', $id)->count();
        $pert=[];
        $pert1 = $pert;
        foreach($pertanyaan as $key=> $pertanyaan){
            array_push($pert, $pertanyaan->id);
        }

        $salah =[];
        if (is_array($pert) || is_object($pert)){
            foreach($pert as $key=> $pert){
                        $usr_ans = mJawaban::where('ujian_id', $id)->
                        where('pertanyaan_id', $pert)->where('poin', 0)
                        ->count();
                        array_push($salah, $usr_ans);
            }
        }

        $ef_pengecoh = [];
        if (is_array($salah) || is_object($salah)){
            foreach($salah as $key=> $salah){
                        $a = ($salah/$jumlah_c)*100;
                        array_push($ef_pengecoh, $a);
            }
        }
        // dd($ypbi, $k20, $k21, $p_array, $d, $sd);

        $ujian = mUjian::find($id);
        $ujian->update([
            'nilai_keandalan_kr20' => $k20,
            'nilai_keandalan_kr21' => $k21,
        ]);

        if($ujian->nilai_keandalan_kr20 >= 0.7){
            $rely20= 'Karena Nilai Keandalan yang Didapatkan >= 0.7, maka dapat dikatakan bahwa <strong> <p class="font-bold col-teal">Soal Memiliki Keandalan yang Tinggi</p></strong>';
        }
        else{
            $rely20= 'Karena Nilai Keandalan yang Didapatkan < 0.7, maka dapat dikatakan bahwa <strong> <p class="font-bold col-pink">Soal Belum Memiliki Keandalan yang Tinggi</p></strong>';
        }
        if($ujian->nilai_keandalan_kr21 >= 0.7){
            $rely21= 'Karena Nilai Keandalan yang Didapatkan >= 0.7, maka dapat dikatakan bahwa <strong> <p class="font-bold col-teal">Soal Memiliki Keandalan yang Tinggi</p></strong>';
        }
        else{
            $rely21= 'Karena Nilai Keandalan yang Didapatkan < 0.7, maka dapat dikatakan bahwa <strong> <p class="font-bold col-pink">Soal Belum Memiliki Keandalan yang Tinggi</p></strong>';
        }


        $updatePertanyaan = mPertanyaan::where('ujian_id', $id)->get();
        foreach($updatePertanyaan as $key => $updatePertanyaan){
            $updatePertanyaan->update([
                'nilai_derajat_kesukaran' => $p_array[$key],
                'nilai_dayabeda' => $d[$key],
                'nilai_validitas' => $ypbi[$key],
                'fungsi_pengecoh' => $ef_pengecoh[$key],
            ]);
        }





        
        //dd($ypbi, $k20, $k21, $p_array, $d);
        return $dataTable->with('id', $ujian->id)
        ->render('ujian.analisis', compact('ujian', 'rely20', 'rely21'));

    }

    public function enrolledAdmin($id, EnrolledAdminDataTable $dataTable){
        
        $ujian = mUjian::find($id);
        $enrollujian = mEnrollUjian::where('ujian_id', $id)->get();

    
        return $dataTable->with('id', $ujian->id)
            ->render('ujian.enrolled_admin', compact('enrollujian', 'ujian'));
    }







}