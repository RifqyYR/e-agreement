<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;

class SewaKendaraanController extends Controller
{
    public function sewaKendaraan()
    {
        $agreements = Agreement::where('agreementType', 'sewa kendaraan')->paginate(10);
        return view('pages.agreement', [
            'title' => "Sewa Kendaraan",
            'agreements' => $agreements,
        ]);
    }

    public function search(Request $request)
    {
        $agreements = Agreement::where('agreementType', 'sewa kendaraan')->get();
        if ($request->keyword != '') {
            $agreements = Agreement::query()
                                    ->where(function ($query) use ($request){
                                        $query->where('agreementType', 'sewa kendaraan')
                                            ->where('title', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->orWhere(function ($query) use ($request){
                                        $query->where('agreementType', 'sewa kendaraan')
                                            ->where('agreementNumber', 'LIKE', '%' . $request->keyword . '%');
                                    })
                                    ->get();
        }
        return response()->json([
            'agreements' => $agreements,
        ]);
    }
}
