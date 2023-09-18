<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;

class TUKSTERSUSController extends Controller
{
    public function tuksTersus()
    {
        $agreements = Agreement::where('agreementType', 'tuks-tersus')->paginate(10);
        return view('pages.agreement', [
            'title' => "TUKS-TERSUS",
            'agreements' => $agreements,
        ]);
    }

    public function search(Request $request)
    {
        $agreements = Agreement::where('agreementType', 'tuks-tersus')->get();
        if ($request->keyword != '') {
            $agreements = Agreement::query()
                                    ->where(function ($query) use ($request){
                                        $query->where('agreementType', 'tuks-tersus')
                                            ->where('title', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->orWhere(function ($query) use ($request){
                                        $query->where('agreementType', 'tuks-tersus')
                                            ->where('agreementNumber', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->get();
        }
        return response()->json([
            'agreements' => $agreements,
        ]);
    }
}
