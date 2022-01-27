<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use App\Models\Domain;
use App\Models\Changelogs;
use App\Models\PublicationState;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
    public function update(Request $request,$practiceId)
    {
        $practice = Practice::where('id', '=', $practiceId)->first();
        if(!Auth::User()){
            abort(403);
        }
        if(Auth::User()->cannot("update",$practice)){
            abort(403);
        }
        if(Str::length($request["title"])<3 | Str::length($request["title"])>40 ){
            return redirect()->back()->withErrors("Error: Please check that the title is longer than 3 characters and shorter than 40");
        }
        if(!Practice::titleAvailable($request["title"])){
            return redirect()->back()->withErrors("Error: Title already used");
        }
        Changelogs::create(['reason'=>$request["reason"],'previously'=>$practice->name,'user_id'=>Auth::User()->id,'practice_id'=>$practice->id]);
        $practice->name = $request["title"];
        $practice->save();
        return redirect()->back();
    }
}
