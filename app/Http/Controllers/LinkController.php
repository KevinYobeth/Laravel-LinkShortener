<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Link;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::where('user_id', Auth::user()->id)->get();

        return view('dashboard', ['links' => $links]);
    }

    public function shorten()
    {
        $randomSlug = Str::random(5);

        return view('shortener', ['randomSlug' => $randomSlug]);
    }

    public function revertStatus($id)
    {
        $link = Link::findorFail($id);
        $link->status = !$link->status;
        $link->save();

        return back();
    }

    public function store(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'name' => ['bail', 'required', 'string', 'max: 50'],
            'url' => ['bail', 'required', 'url'],
            'slug' => ['bail', 'required', 'string', 'max:30', 'unique:links,slug'],
        ]);

        if ($validator->fails()) {
            Alert::error('Error',  $validator->errors()->first());
            return back()->withInput();
        }

        $link = new Link;

        $link->name = $r->name;
        $link->link = $r->url;
        $link->slug = $r->slug;
        $link->user_id = Auth::check() ? Auth::id() : 1;

        $link->save();

        return redirect()->route('showLink', ['slug' => $link->slug]);
    }

    public function downloadQR($slug)
    {
        $dest = storage_path('app/qrCode.svg');
        $url =  env('APP_URL') . $slug;

        QrCode::margin(2)->size(400)->generate($url, $dest);
        return response()->download($dest);
    }

    public function edit($slug)
    {
        $link = Link::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        return view('link.edit', ['link' => $link]);
    }

    public function update(Request $r, $slug)
    {
        $link = Link::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        $validator = Validator::make($r->all(), [
            'name' => ['bail', 'required', 'string', 'max: 50'],
            'url' => ['bail', 'required', 'url'],
            'slug' => ['bail', 'required', 'string', 'max:30', Rule::unique('links')->ignore($link->id, 'id')],
        ]);

        if ($validator->fails()) {
            Alert::error('Error',  $validator->errors()->first());
            return back()->withInput();
        }

        $link->link = $r->url;
        $link->slug = $r->slug;
        $link->name = $r->name;
        $link->status = $r->linkStatus;

        $link->save();


        Alert::toast('Link updated succesfully!', 'success');
        return redirect()->route('showLink', ['slug' => $link->slug]);
    }

    public function delete($slug)
    {
        $link = Link::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        $link->delete();

        Alert::toast('Link deleted successfully!', 'error');
        return redirect()->route('dashboard');
    }

    public function show($slug)
    {
        $link = Link::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        return view('link.show', ['link' => $link]);
    }

    public function redirect($slug)
    {
        $link = Link::where('slug', $slug)->firstOrFail();
        if ($link->status === 0) {
            abort(404);
        }

        $link->increment('counter', 1);
        return redirect($link->link);
    }
}
