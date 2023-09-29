<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;

class SewaBangunanController extends Controller
{
    public function sewaBangunan()
    {
        $agreements = Agreement::where('agreementType', 'sewa bangunan')->paginate(10);
        return view('pages.agreement', [
            'title' => "Sewa Bangunan",
            'agreements' => $agreements,
        ]);
    }

    public function search(Request $request)
    {
        $agreements = Agreement::where('agreementType', 'sewa bangunan')->get();
        if ($request->keyword != '') {
            $agreements = Agreement::query()
                ->where(function ($query) use ($request) {
                    $query->where('agreementType', 'sewa bangunan')
                        ->where('title', 'LIKE', '%' . $request->keyword . '%');
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('agreementType', 'sewa bangunan')
                        ->where('agreementNumber', 'LIKE', '%' . $request->keyword . '%');
                })
                ->get();
        }
        return response()->json([
            'agreements' => $agreements,
        ]);
    }
}
