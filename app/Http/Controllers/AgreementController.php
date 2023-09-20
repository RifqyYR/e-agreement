<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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

    public function detail(Agreement $agreement)
    {
        return view('pages.detail', [
            'agreement' => $agreement,
        ]);
    }

    public function edit(Agreement $agreement)
    {
        return view('pages.edit', [
            'agreement' => $agreement,
        ]);
    }

    public function editProcess(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'mimes' => ':attribute harus berekstensi pdf',
        ];

        $agreement = Agreement::where('id', $request->id)->first();

        $this->validate($request, [
            'nomorSurat' => 'required',
            'namaSurat' => 'required|min:10',
            'jenisPerjanjian' => 'required',
            'mitra' => 'required|min:10',
            'tanggalPenandatanganan' => 'required',
            'tanggalBerlaku' => 'required',
            'tanggalBerakhir' => 'required',
            'unit' => 'required',
            'suratPerjanjian' => 'mimes:doc,pdf,docx,zip'
        ], $messages);

        
        if ($request->hasFile('suratPerjanjian')) {
            $file = $request->file('suratPerjanjian');
            $name = now()->timestamp . "_{$file->getClientOriginalName()}";
            $path = $request->file('suratPerjanjian')->storeAs('files/perjanjian/'.$request->jenisPerjanjian, $name, 'public');

            if (File::exists('storage/'.$path)) {
                File::delete('storage/'.$path);
            }

            $agreement->update([
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
        } else {
            $agreement->update([
                'title' => $request->namaSurat,
                'agreementNumber' => $request->nomorSurat,
                'agreementType' => $request->jenisPerjanjian,
                'partner' => $request->mitra,
                'unit' => $request->unit,
                'signDate' => $request->tanggalPenandatanganan,
                'startDate' => $request->tanggalBerlaku,
                'endDate' => $request->tanggalBerakhir,
            ]);
        }

        if($agreement) {
            return redirect()->route('home')->with('success', 'Berhasil menambahkan surat baru');
        } else {
            return redirect()->back()->with('error', 'Something goes wrong while uploading file!');
        }
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
            $name = now()->timestamp . "_{$file->getClientOriginalName()}";
            $path = $request->file('suratPerjanjian')->storeAs('files/perjanjian/'.$request->jenisPerjanjian, $name, 'public');
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
