<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use App\Models\Domain;
use App\Models\PublicationState;
use Illuminate\Http\Request;
use Auth;

class PracticeController extends Controller
{
    public function index()
    {
        if (Auth::User()->role->slug == "MBR") {
            return redirect()->back();
        }
        $domains = Domain::All();
        return view('Practices')->with(["domains" => $domains]);
    }
    public function show($id)
    {
        $practice = Practice::where('id', '=', $id)->first();
        if ($practice == null) {
            return redirect()->back()->withErrors("Error: Practice not found");
        }
        if ($practice->publicationState != PublicationState::where('slug', 'PUB')->first() && Auth::User()->cannot("moderator")) {
            return redirect()->back()->withErrors("Error: Practice not published");
        }

        return view('practice')->with(["practice" => $practice]);
    }
    public function publish($id)
    {
        $practice = Practice::where('id', '=', $id)->first();
        if ($practice == null) {
            return redirect()->back()->withErrors("Error: Practice not found");
        }
        if (Auth::User()->can('publish', $practice)) {
            $practice->publish();
            return redirect("/");
        }
        return redirect()->back()->withErrors("Error: You can't do that");
    }
    public function OpenPracticeOpinionsPage($practiceId)
    {
        $practice = Practice::where('id', '=', $practiceId)->first();
        if ($practice == null) {
            return redirect()->back()->withErrors("Error: Practice not found");
        }
        return view('practiceOpinions')->with(["practice" => $practice]);
    }
}
