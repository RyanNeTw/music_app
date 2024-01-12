<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $playlists = $user->playlists()->with(['tracks', 'user'])->get();

        return Inertia::render("Playlist/Index", [
            "playlists" => $playlists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tracks = Track::where('display', true)
        ->orderBy('id', 'desc')
        ->get();

        return Inertia::render("Playlist/Create", [
            "tracks" => $tracks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            "title" => "required",
            'tracks' => ['required', 'array', 'min:1'],
            'tracks.*' => ['required', 'string', 'exists:tracks,uuid', 'distinct'],
        ]);

        $tracks = Track::whereIn('uuid', $request->tracks)->get();

        if ($tracks->count() !== count($request->tracks)) {
            throw ValidationException::withMessages([
                'tracks' => 'Invalid track in array'
            ]);
        }

        $playlist = Playlist::create([
            "uuid" => 'ply-' . Str::uuid(),
            "user_id" => auth()->user()->id,
            "title" => $request->title,
        ]);

        $playlist->tracks()->sync($tracks->pluck('id'));

        return redirect()->route("playlists.index");

    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        return Inertia::render("Playlist/Show", [
            "playlist" => $playlist->load(['tracks', 'user']),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        //
    }
}
