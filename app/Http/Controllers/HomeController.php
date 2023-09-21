<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Carbon\Carbon;

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
        $agreements = Agreement::all();
        $total_agreemnts = count($agreements);
        $total_expired_agreements = array();

        foreach ($agreements as $item) {
            $startDate = Carbon::parse($item->startDate);
            $endDate = Carbon::parse($item->endDate);
            $diff = $startDate->diffInDays($endDate);
            if ($diff <= 10) {
                array_push($total_expired_agreements, $diff);
            }
        }
        
        return view('pages.home', [
            'total_agreements' => $total_agreemnts,
            'total_expired_agreements' => count($total_expired_agreements),
        ]);
    }

    public function logout()
    {
        return view('auth.login');
    }
}
