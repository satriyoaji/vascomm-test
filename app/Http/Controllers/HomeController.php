<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\EvaluationCategory;
use App\Indeksasi;
use App\Jurnal;
use App\User;
use App\UserJurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use function foo\func;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $compact = [];
        return view('pages/admin/dashboard', compact($compact));
    }

    public function landingPage(Request $request)
    {
        return view('landing-page');
    }

}
