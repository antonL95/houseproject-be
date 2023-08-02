<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Models\Place;

class PlaceController extends Controller
{
    public function index()
    {
        return Place::all();
    }

    public function store(PlaceRequest $request)
    {
        return Place::create($request->validated());
    }

    public function show(Place $place)
    {
        return $place;
    }

    public function update(PlaceRequest $request, Place $place)
    {
        $place->update($request->validated());

        return $place;
    }

    public function destroy(Place $place)
    {
        $place->delete();

        return response()->json();
    }
}
