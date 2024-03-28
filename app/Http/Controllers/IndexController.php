<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about(Request $request)
    {
        dd($request);
        $section = "<h1></h1>";
        return view("about", compact("section"));
    }

    public function contact()
    {
        return view("contact");
    }

    
}
