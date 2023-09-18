<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;

class LainnyaController extends Controller
{
    public function lainnya()
    {
        $agreements = Agreement::where('agreementType', 'lainnya')->paginate(10);
        return view('pages.agreement', [
            'title' => "Lainnya",
            'agreements' => $agreements,
        ]);
    }

    public function search(Request $request)
    {
        $agreements = Agreement::where('agreementType', 'lainnya')->get();
        if ($request->keyword != '') {
            $agreements = Agreement::query()
                                    ->where(function ($query) use ($request){
                                        $query->where('agreementType', 'lainnya')
                                            ->where('title', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->orWhere(function ($query) use ($request){
                                        $query->where('agreementType', 'lainnya')
                                            ->where('agreementNumber', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->get();
        }
        return response()->json([
            'agreements' => $agreements,
        ]);
    }
}
