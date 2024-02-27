<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
       
        return view('auth.login');
    }
}
