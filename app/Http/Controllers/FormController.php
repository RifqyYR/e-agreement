<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return view('pages.pks');
    }

    public function create()
    {
        return view('pages.create');
    }

    public function proses(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
        ];

        $this->validate($request, [
            'nomorSurat' => 'required',
            'namaSurat' => 'required|min:10',
            'mitra' => 'required|min:10',
            'suratPerjanjian' => 'required|max:2048'
        ], $messages);

        try{
            $file = $request->file('suratPerjanjian');
            $name = now()->timestamp.".{$file->getClientOriginalName()}";
            $path = $request->file('suratPerjanjian')->storeAs('files', $name, 'public');

            return redirect()->back()->with('success','File Upload Successfully!!');
        }catch(\Exception $e){
            return redirect()->back()->with('error','Something goes wrong while uploading file!');
        }
    }
}
