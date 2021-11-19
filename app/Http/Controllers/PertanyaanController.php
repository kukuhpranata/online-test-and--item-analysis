<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mUjian;
use App\mPertanyaan;
use App\mEnrollUjian;
use App\mjawaban;
use App\DataTables\PertanyaanDataTable;
use App\DataTables\HasilDataTable;
use Session;
use Auth;


class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }




    public function indexPertanyaan($ujian_id, PertanyaanDataTable $dataTable){
        
        $ujian = mUjian::with('user')->find($ujian_id);
        
        $count_pertanyaan = mPertanyaan::with('ujian')->where('ujian_id', $ujian->id)->count();
        //dd($count_pertanyaan);

        
        return $dataTable->with('id', $ujian->id)
            ->render('pertanyaan.index', compact('ujian', 'count_pertanyaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPertanyaan($ujian_id)
    {
        $ujian = mUjian::find($ujian_id);
        return view('pertanyaan.create',compact('ujian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePertanyaan($ujian_id, Request $request)
    {
        $this->validate($request , [
            'judul' => 'required',
           // 'opsi1' => 'required',
           // 'opsi2' => 'required',
          //  'opsi3' => 'required',
          //  'opsi4' => 'required',
           // 'opsi5' => 'required',
        ]);


    /*    $opsi = $request->get('opsi');
        $opsi_a = count($request->get('opsi'));
        //dd($opsi_a); // see if it work
        $opsi_no = [1,2,3,4,5]; */





        $ujian = mUjian::find($ujian_id);

        $pertanyaan = mPertanyaan::create([
            'ujian_id' => $ujian ->id,
            'judul_soal' => $request->judul,
            'opsi1' => $request->opsi1,
            'opsi2' => $request->opsi2,
            'opsi3' => $request->opsi3,
            'opsi4' => $request->opsi4,
            'opsi5' => $request->opsi5,
            'jawaban' => $request->jawaban,
           
        ]);




      /*   foreach($opsi as $key=> $opsi){
            
            $new_opsi = mOpsi::first();
            
                $new_opsi = new mOpsi();
                $new_opsi->pertanyaan_id = $pertanyaan->id;
                $new_opsi->nomor_opsi = $opsi_no[$key];
                $new_opsi->judul_opsi = $opsi;
                $new_opsi->save();
        } */
    

        Session::flash("flash_notification",[
            "level" => "green",
            "message" => "Berhasil Menyimpan Data Pertanyaan"
        ]);
        
        return redirect()->route('pertanyaanindex',[$ujian->id]);
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
    public function editPertanyaan($id)
    {
        $pertanyaan = mPertanyaan::find($id);
        $ujian = mUjian::find($pertanyaan->ujian_id);

        return view('pertanyaan.edit')->with(compact('pertanyaan','ujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePertanyaan(Request $request, $ujian_id)
    {

    

        $pertanyaan = mPertanyaan::find($ujian_id);
        $ujian = mUjian::find($pertanyaan->ujian_id);

        $pertanyaan->update([
            'ujian_id' => $ujian ->id,
            'judul_soal' => $request->judul,
            'opsi1' => $request->opsi1,
            'opsi2' => $request->opsi2,
            'opsi3' => $request->opsi3,
            'opsi4' => $request->opsi4,
            'opsi5' => $request->opsi5,
            'jawaban' => $request->jawaban,
           
        ]);

        Session::flash("flash_notification",[
            "level" => "green",
            "message" => "Berhasil Menyunting Data Pertanyaan"
        ]);
        
        return redirect()->route('pertanyaanindex',[$ujian->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPertanyaan($id)
    {
        $pertanyaan = mPertanyaan::find($id);
        $ujian = mUjian::find($pertanyaan->ujian_id);
        
        mPertanyaan::destroy($id);

        Session::flash("flash_notification",[
                "level" => "green",
                "message" => "Berhasil Menghapus Pertanyaan"
        ]);

        return redirect()->route('pertanyaanindex',[$ujian->id]);
    }

    public function indexHasil($id, HasilDataTable $dataTable){
        
        $enrollujian = mEnrollUjian::find($id);

        $ujian = mUjian::find($enrollujian->ujian_id);
        
        $hasil = mJawaban::with('user', 'ujian', 'pertanyaan')->where('user_id', Auth::user()->id)
        ->where('ujian_id', $enrollujian->ujian_id)->get();

        //dd($hasil);

        
        return $dataTable->with('id', $enrollujian->id)
            ->render('view_ujian.hasil', compact('enrollujian'));
    }

    public function adminHasil($id, HasilDataTable $dataTable){
        
        $enrollujian = mEnrollUjian::find($id);

        $ujian = mUjian::find($enrollujian->ujian_id);
        
        return $dataTable->with('id', $enrollujian->id)
            ->render('view_ujian.hasil_admin', compact('enrollujian'));
    }

    


}
