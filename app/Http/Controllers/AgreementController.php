<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::paginate(10);
        return view('pages.agreement', compact('agreements'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function uploadProcess(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'mimes' => ':attribute harus berekstensi pdf',
        ];

        $this->validate($request, [
            'nomorSurat' => 'required',
            'namaSurat' => 'required|min:10',
            'jenisPerjanjian' => 'required',
            'mitra' => 'required|min:10',
            'tanggalPenandatanganan' => 'required',
            'tanggalBerlaku' => 'required',
            'tanggalBerakhir' => 'required',
            'unit' => 'required',
            'suratPerjanjian' => 'required|mimes:doc,pdf,docx,zip'
        ], $messages);

        try {
            $file = $request->file('suratPerjanjian');
            $name = now()->timestamp . ".{$file->getClientOriginalName()}";
            $path = $request->file('suratPerjanjian')->storeAs('files/perjanjian/'.$request->agreementType, $name, 'public');
            $agreement = Agreement::create([
                'id' => Uuid::uuid4(),
                'title' => $request->namaSurat,
                'agreementNumber' => $request->nomorSurat,
                'agreementType' => $request->jenisPerjanjian,
                'partner' => $request->mitra,
                'unit' => $request->unit,
                'signDate' => $request->tanggalPenandatanganan,
                'startDate' => $request->tanggalBerlaku,
                'endDate' => $request->tanggalBerakhir,
                'fileName' => $path,
            ]);

            if ($agreement) {
                return redirect()->route('home')->with('success', 'Berhasil menambahkan surat baru');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something goes wrong while uploading file!');
        }
    }
}
