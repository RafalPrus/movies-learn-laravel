<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        $popularActors = Http::withToken(config('services.tmdb.token'))
            ->get("https://api.themoviedb.org/3/person/popular?page={$page}")
            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);
        dump($popularActors);

        return view('actors.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
