<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $agreements = Agreement::orderBy('endDate', 'DESC')->get();
        $total_agreemnts = count($agreements);
        $total_expired_agreements = array();
        $endDateTreshold = Carbon::now()->addDays(10);
        $agreementsEndingSoon = $agreements->where('endDate', '<=', $endDateTreshold);

        foreach ($agreements as $item) {
            $startDate = Carbon::now();
            $endDate = Carbon::parse($item->endDate);
            $diff = $endDate->diffInDays($startDate);
            if ($diff <= 10) {
                array_push($total_expired_agreements, $diff);
            }
        }

        if ($agreementsEndingSoon->isNotEmpty()) {
            return view('pages.home', [
                'total_agreements' => $total_agreemnts,
                'total_expired_agreements' => $agreementsEndingSoon->count(),
                'agreements' => $agreements,
                'ending_agreements' => $agreementsEndingSoon
            ]);
        }

        return view('pages.home', [
            'total_agreements' => $total_agreemnts,
            'total_expired_agreements' => $agreementsEndingSoon->count(),
            'agreements' => $agreements,
            'ending_agreements' => $agreementsEndingSoon
        ]);
    }

    public function logout()
    {
        return view('auth.login');
    }

    public function getData()
    {
        $agreements = Agreement::orderBy('endDate', 'DESC');
        $endDateTreshold = Carbon::now()->addDays(10);
        $agreementsEndingSoon = $agreements->where('endDate', '<=', $endDateTreshold)->get();

        return response()->json([
            'agreements' => $agreementsEndingSoon,
        ]);
    }

    public function search(Request $request)
    {
        $agreements = Agreement::orderBy('endDate', 'DESC')->get();
        $endDateTreshold = Carbon::now()->addDays(10);
        $agreementsEndingSoon = $agreements->where('endDate', '<=', $endDateTreshold);

        if ($request->keyword != '') {
            $agreementsEndingSoon = Agreement::query()
                ->where(function ($query) use ($request, $endDateTreshold){
                    $query->where('agreementType', 'sarpras')
                        ->where('title', 'LIKE', '%' . $request->keyword . '%')
                        ->where('endDate', '<=', $endDateTreshold);
                })
                ->orWhere(function ($query) use ($request, $endDateTreshold){
                    $query->where('agreementType', 'sarpras')
                        ->where('agreementNumber', 'LIKE', '%' . $request->keyword . '%')
                        ->where('endDate', '<=', $endDateTreshold);
                })
                ->where('endDate', '<=', $endDateTreshold)
                ->orderBy('endDate', 'DESC')
                ->get();
        } elseif($request->keyword == '') {
            $agreementsEndingSoon = Agreement::where('endDate', '<=', $endDateTreshold)->orderBy('endDate', 'DESC')->get();
        }
        return response()->json([
            'agreements' => $agreementsEndingSoon,
        ]);
    }
}
