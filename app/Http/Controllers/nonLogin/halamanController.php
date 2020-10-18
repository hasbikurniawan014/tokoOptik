<?php

namespace App\Http\Controllers\nonLogin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;


use Illuminate\Support\Facades\Hash;
class halamanController extends Controller
{
    /**
     * menampilkan halaman login 
     *
     * @return view
     **/
    public function index()
    {
    	$title="Halaman Depan";
    	return view('non-login.index',compact('title'));
    }

}
