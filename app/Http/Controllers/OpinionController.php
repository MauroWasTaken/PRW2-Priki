<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpinionController extends Controller
{
    public function addComment(Request $request, $practiceId, $opinionId)
    {
        $opinion = Opinion::find($opinionId);
        $comment = $request['comment'];
        if (strlen($comment) > 1000) {
            return redirect()->back()->withErrors(['msg' => 'The message exceeds 1000 characters !']);
        } else if (strlen($comment) <= 0 || strlen($comment) == null) {
            return redirect()->back()->withErrors(['msg' => 'Please enter a comment.']);
        }
        $opinion->comments()->attach(Auth::user(), array("comment" => $request['comment'],"points"=>$request['voteRadioOptions']));
        return redirect()->back();
    }
}
