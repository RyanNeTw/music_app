<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Http\Request;


class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apiKey = ApiKey::where('key', request()->header('x-api-key'))->first();

        $user = User::where('id', $apiKey->user_id)->first();

        $playlists = $user->playlists()->with(['tracks', 'user'])->get();

        return response()->json([
            'playlists' => $playlists,
        ]);
    }
}