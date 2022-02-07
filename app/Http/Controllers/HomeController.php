<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Auth;
use DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $models = Transaction::where('user_id', Auth::user()->id)
        ->select('*', DB::raw('DATE(created_at) as date'))
        ->orderBy('date', 'desc')
        ->get()
        
        ->groupBy('date');
        return view('home', compact('models'));
    }
}
