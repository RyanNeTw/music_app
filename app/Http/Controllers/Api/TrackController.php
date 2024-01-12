<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Track;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracks = Track::where('display', true)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'tracks' => $tracks,
        ]);
    }
}