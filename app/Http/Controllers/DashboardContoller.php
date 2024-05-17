<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardContoller extends Controller
{
    //
    public function index()
    {
        $data = [
            "title" => "Dashboard",
        ];

        return view('dashboard.index', $data);
    }
}
