<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {    	
        return view('admin');
    }

    public function adminLogin(Request $request) {
    	$data = $request->all();
    	dd($data);	
    }
}
