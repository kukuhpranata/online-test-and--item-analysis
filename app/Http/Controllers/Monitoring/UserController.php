<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\DataTables\Laporan\UserDataTable;
use Session;
Use Auth;
use PDF;
use Barryvdh\Snappy;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        $image = Auth::user()->image;

		$a = User::with('useremail','role')->get();
        //dd($a);
        return $dataTable->render('user.index', compact('image'));
    }

    public function create()
    {
        $id = 0 ;
        $editdata = User::find($id);
        return view('user.create',compact('editdata'));
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'email' => 'required|email|unique:users',
            'nama' => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ]);
        
        if ($files = $request->file('file')){
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'storage';
		$file->move($tujuan_upload,$nama_file);
        }

        $user = User::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            //'image' => $nama_file,
        ]);

        Session::flash("flash_notification",[
            "level" => "green",
            "message" => "Berhasil Menyimpan Data User $user->nama"
        ]);

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $editdata = User::find($id);
        $user = User::with('useremail','role')->find($id);

        return view('user.edit')->with(compact('user','editdata'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'email' => 'required|email|',
            'nama' => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ]);
        
        $user = User::with('useremail','role')->find($id);
        

        if ($files = $request->file('file')){
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');
    
            $nama_file = time()."_".$file->getClientOriginalName();
    
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'storage';
            $file->move($tujuan_upload,$nama_file);
        }

        //dd($tujuan_upload);

        $user->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            //'image' => $nama_file,
        ]);

        Session::flash("flash_notification",[
            "level" => "green",
            "message" => "Berhasil Merubah Data User $user->nama"
        ]);
        
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        
        User::destroy($id);

        Session::flash("flash_notification",[
                "level" => "green",
                "message" => "Berhasil Menghapus Data User = $user->email"
        ]);

        return redirect()->route("user.index");
    }

    public function getdropdown(Request $request){
        $id = $request->id;
        $data = mBagUnit::where('obj_audit_id',$id)->get();
        echo json_encode($data);
       
       
    }
    
}
