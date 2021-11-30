<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Domain;
class DomainController extends Controller
{
    public function index($slug="all")
    {
        if ($slug=="all"){
            $domains=Domain::All();
        }else{
            $domains=Domain::where('slug',$slug)->get();
        }
        return view('Domains')->with(["domains" => $domains]);
    }
}
