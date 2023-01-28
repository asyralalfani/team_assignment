<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function dashboardAdmin()
    {
        $data = Session::get('data');
        $users = Users::all();

        return view('dashboard_admin' ,['data' => $data, 'users' => $users]);
    }

    public function dashboardKaryawan()
    {
        $data = Session::get('data');

        return view('dashboard_karyawan', ['data' => $data]);
    }
}
