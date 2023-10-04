<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArchiveController extends Controller
{
    public function index()
    {
        $archive = Archive::paginate(10);
        return view('pages.archive', [
            'archives' => $archive,
        ]);
    }

    public function detail(Archive $archive)
    {
        return view('pages.detail', [
            'agreement' => $archive,
        ]);
    }

    public function search(Request $request)
    {
        $agreements = Archive::all();
        if ($request->keyword != '') {
            $agreements = Archive::query()
                ->where(function ($query) use ($request) {
                    $query->where('title', 'LIKE', '%' . $request->keyword . '%');
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('agreementNumber', 'LIKE', '%' . $request->keyword . '%');
                })
                ->get();
        }
        return response()->json([
            'agreements' => $agreements,
        ]);
    }

    public function delete(String $id)
    {
        $agreement = Archive::find($id);
        $path = $agreement->fileName;
        if (File::exists('storage/' . $path)) {
            File::delete('storage/' . $path);
        }
        $agreement->delete();

        if ($agreement) {
            return redirect()->route('arsip')->with('success', 'Berhasil menghapus arsip perjanjian');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus arsip perjanjian');
        }
    }
}
