<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;

class SarprasController extends Controller
{
    public function sarpras()
    {
        $agreements = Agreement::where('agreementType', 'sarpras')->paginate(10);
        return view('pages.agreement', [
            'title' => "SARPRAS",
            'agreements' => $agreements,
        ]);
    }

    public function search(Request $request)
    {
        $agreements = Agreement::where('agreementType', 'sarpras')->get();
        if ($request->keyword != '') {
            $agreements = Agreement::query()
                                    ->where(function ($query) use ($request){
                                        $query->where('agreementType', 'sarpras')
                                            ->where('title', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->orWhere(function ($query) use ($request){
                                        $query->where('agreementType', 'sarpras')
                                            ->where('agreementNumber', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->get();
        }
        return response()->json([
            'agreements' => $agreements,
        ]);
    }
}
