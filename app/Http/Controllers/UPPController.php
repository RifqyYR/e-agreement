<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;

class UPPController extends Controller
{
    public function upp()
    {
        $agreements = Agreement::where('agreementType', 'upp')->paginate(10);
        return view('pages.agreement', [
            'title' => "UPP",
            'agreements' => $agreements,
        ]);
    }

    public function search(Request $request)
    {
        $agreements = Agreement::where('agreementType', 'upp')->get();
        if ($request->keyword != '') {
            $agreements = Agreement::query()
                                    ->where(function ($query) use ($request){
                                        $query->where('agreementType', 'upp')
                                            ->where('title', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->orWhere(function ($query) use ($request){
                                        $query->where('agreementType', 'upp')
                                            ->where('agreementNumber', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->get();
        }
        return response()->json([
            'agreements' => $agreements,
        ]);
    }
}
