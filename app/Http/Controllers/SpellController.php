<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpellResource;
use App\Models\Spell;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SpellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->input('spell_type')) {
            $spells = Spell::whereHas('spell_type', function (Builder $query) {
                global $request;
                $query->where('spell_types.id', $request->input('spell_type'));
            })->get();
            return SpellResource::collection($spells);
        }
        return SpellResource::collection(Spell::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:spells|max:255',
            'damage' => 'required|numeric|min:0',
            'spell_type_id' => 'required|exists:spell_types,id'
        ]);

        $spell = Spell::create([
            'name' => $validated['name'],
            'damage' => $validated['damage'],
            'spell_type_id' => $validated['spell_type_id']
        ]);

        return new SpellResource($spell);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new SpellResource(Spell::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => "required|unique:spells,name,{$id}|max:255",
            'damage' => 'required|numeric|min:0',
            'spell_type_id' => 'required|exists:spell_types,id'
        ]);

        $spell = Spell::findOrFail($id);
        $spell->name = $validated['name'];
        $spell->damage = $validated['damage'];
        $spell->spell_type_id = $validated['spell_type_id'];
        $spell->save();

        return new SpellResource($spell);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spell = Spell::findOrFail($id);
        $spell->delete();
    }
}
