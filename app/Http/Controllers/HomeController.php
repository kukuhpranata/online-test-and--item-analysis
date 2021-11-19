<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UjianDataTable;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UjianDataTable $dataTable)
    {
        return $dataTable->render('home');
    }

    public function indexLogin()
    {
        return view('auth.login');
    }

}
