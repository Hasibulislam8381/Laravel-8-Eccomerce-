<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangePass extends Controller
{
    //
    public function Cpassword()
    {
        return view('admin.body.changepassword');
    }
}
