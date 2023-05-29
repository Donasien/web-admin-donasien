<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index()
    {
        $totalUser = UserData::count();
        $totalDonasi = Donasi::count();

        return view('Dashboard.dashboard', compact('totalUser', 'totalDonasi'))->with([
            'user' => Auth::user(),
        ]);
    }
}
