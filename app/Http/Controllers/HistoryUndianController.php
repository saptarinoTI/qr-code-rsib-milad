<?php

namespace App\Http\Controllers;

use App\Models\HasilUndian;
use Illuminate\Http\Request;

class HistoryUndianController extends Controller
{
    public function index()
    {
        $datas = HasilUndian::with('peserta')->orderBy('created_at', 'desc')->get();
        return view("app.history.doorprize", compact("datas"));
    }
}
