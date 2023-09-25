<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            $tipePerjanjian = $request->jenisPerjanjian;
            $tipePerjanjianBaru = str_replace(" ", "", $tipePerjanjian);
            $path = $request->file('suratPerjanjian')->storeAs('files/perjanjian/'.$tipePerjanjianBaru, $name, 'public');
            $oldPath = $agreement->fileName;

            if (File::exists('storage/'.$oldPath)) {
                File::delete('storage/'.$oldPath);
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
            return redirect()->route('home')->with('success', 'Berhasil update perjanjian baru');
        } else {
            return redirect()->back()->with('error', 'Gagal update perjanjian baru');
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
            $tipePerjanjian = $request->jenisPerjanjian;
            $tipePerjanjianBaru = str_replace(" ", "", $tipePerjanjian);
            $path = $request->file('suratPerjanjian')->storeAs('files/perjanjian/'.$tipePerjanjianBaru, $name, 'public');
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
                return redirect()->route('home')->with('success', 'Berhasil menambahkan perjanjian baru');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan perjanjian baru');
        }
    }

    public function delete(String $id)
    {
        $agreement = Agreement::find($id);
        $path = $agreement->fileName;
        if (File::exists('storage/'.$path)) {
            File::delete('storage/'.$path);
        }
        $agreement->delete();

        if ($agreement) {
            return redirect()->route('home')->with('success', 'Berhasil menghapus perjanjian');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus perjanjian');
        }
    }

    public function archive()
    {
        return view('pages.archive');
    }
}
