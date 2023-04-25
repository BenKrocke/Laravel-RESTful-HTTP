<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpellTypeResource;
use App\Models\SpellType;
use Illuminate\Http\Request;

class SpellTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SpellTypeResource::collection(SpellType::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:spell_types|max:255'
        ]);

        $spellType = SpellType::create([
            'name' => $validated['name']
        ]);

        return new SpellTypeResource($spellType);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new SpellTypeResource(SpellType::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => "required|unique:spell_types,name,{$id}|max:255"
        ]);

        $spellType = SpellType::findOrFail($id);
        $spellType->name = $validated['name'];
        $spellType->save();

        return new SpellTypeResource($spellType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spellType = SpellType::findOrFail($id);
        $spellType->delete();
    }
}
