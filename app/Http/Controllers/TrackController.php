<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TrackController extends Controller
{
    public function index()
    {

        $tracks = Track::where('display', true)
        ->orderBy('id', 'desc')
        ->get();

        return Inertia::render("Track/Index", [
            "tracks" => $tracks,
            'create_url' => route('tracks.index')
        ]);
    }

    public function create()
    {
        return Inertia::render("Track/Create", [
            'create_url' => route('tracks.create')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'artist' => ['string', 'required', 'max:255'],
            'image' => ['image', 'required'],
            'music' => ['file', 'extensions:mp3,wav', 'required'],
            'display' => ['boolean', 'required'],
        ]);

        $uuid = 'trk-' . Str::uuid();

        $imageExtension = $request->image->extension();
        $musicExtension = $request->music->extension();

        $imagePath = $request->image->storeAs('tracks/images', 'img-' . $uuid . '.' . $imageExtension);
        $musicPath = $request->music->storeAs('tracks/musics', 'music-' . $uuid . '.' . $musicExtension);

        Track::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'artist' => $request->artist,
            'image' => $imagePath,
            'music' => $musicPath,
            'display' => $request->display,
        ]);

        return redirect()->route('tracks.create', [
            'response' => 'success'
        ]);
    }
}
