<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($filterValue)
    {
        return view('home')->with(["filterValue" => $filterValue]);
    }
}
