<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ApikeyController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $user = request()->user();
        $apikeys = $user->apikeys()->with(['user'])->get();

        return Inertia::render("Apikey/Index", [
            "apikeys" => $apikeys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apikeys = Apikey::all();

        return Inertia::render("Apikey/Create", [
            "apikeys" => $apikeys,
        ]);
    }

       /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            "name" => "required",
        ]);

        $apikey = Apikey::create([
            "uuid" => 'ply-' . Str::uuid(),
            "user_id" => auth()->user()->id,
            "name" => $request->name,
            "key" => Str::random(40)
        ]);

        return redirect()->route("apikeys.index");

    }
}
