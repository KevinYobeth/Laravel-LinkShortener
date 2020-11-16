<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        $link = Link::all();
        error_log($link);
    }

    public function store(Request $request)
    {
        $link = new Link;

        $link->link = $request->urlToShorten;
        $link->slug = Str::random(5);
        $link->name = 'Link';
        $link->user_id = Auth::check() ? Auth::id() : 1;

        $link->save();

        return back()->with('link', env('APP_URL') . $link->slug);
    }

    public function redirect($slug)
    {
        $link = Link::where('slug', $slug)->first();
        return redirect($link->link);
    }
}
