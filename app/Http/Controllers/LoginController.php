<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Rules\Is_Password_Same;
use App\Rules\Is_User_Exist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        /**
         * Validator
         * Validator berfungsi sebagai tahap awal validasi
         *
         * required = inputan yang dikirim harus mempunyai nilai tidak boleh kosong
         * email = inputan harus berupa email dengan format yang valid
         * alpha_dash = inputan yang dimasukkan hanya berupa huruf dan (_,-)
         * rule Is_User_Exist = untuk mengecek apakah user berdasarkan email yang dimasukkan ada
         * rule Is_Password_Same = untuk mengecek password yang dimasukkan benar atau salah
         */
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', new Is_User_Exist($request->email)],
            'password' => ['required', 'alpha_dash', new Is_Password_Same($request->email)],
        ]);

        // apabila dari proses validasi terdapat gagal,
        // maka akan dikembalikan ke halaman utama dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->with(['status' => 'errors', 'message' => $validator->errors()->first()]);
        }

        // query untuk untuk mendapatkan data user berdasarkan email yang telah diinputkan
        // serta melakukan proses join untuk mendapatkan role
        $data = Users::where('email', $request->email)
                ->selectRaw('users.*, roles.*')
                ->leftJoin('roles', 'roles.id', 'users.role_id')
                ->first();

        $redirect = $data->role_id == 1 ? "dashboard.admin" : "dashboard.karyawan";

        // untuk membuat session baru yang bertugas menyimpan data user
        Session::put("data", $data);

        // apabila semua proses berhasil dilakukan
        // maka akan diarahkan menuju dashboard berdasarkan role dari user tersebut
        return redirect()->route($redirect);
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('login.page');
    }
}
