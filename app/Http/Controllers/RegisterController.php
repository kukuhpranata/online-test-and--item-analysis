<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\mRegister;
use App\User;
use App\DataTables\RegisterDataTable;
use Session;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRegistered(RegisterDataTable $dataTable)
    {
        return $dataTable->render('user.index_registrasi');
    }

    public function indexRegister()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Registerstore(Request $request)
    {
        $this->validate($request , [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $register = User::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' =>bcrypt($request->password),
            'role_id' => 2,
            'status_akun' => 1
        ]);

        Session::flash("flash_notification",[
            "level" => "green",
            "message" => "Berhasil Mendaftar, Silakan Tunggu Konfirmasi, Cek email Secara Berkala"
        ]);

        return view('auth.register');


    }

    public function Userstore(Request $request, $id)
    {
        $user = User::with('useremail','role')->find($id);
        //dd($register);


        $user->update([
            'status_akun' => 2,
        ]);

        Session::flash("flash_notification",[
            "level" => "green",
            "message" => "Akun $user->nama diterima"
        ]);

        return redirect()->route('registered.index');


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
