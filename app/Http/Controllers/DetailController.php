<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DetailController extends Controller
{
    public function index(Agreement $agreement)
    {
        return view('pages.detail', [
            'agreement' => $agreement,
        ]);
    }
}
