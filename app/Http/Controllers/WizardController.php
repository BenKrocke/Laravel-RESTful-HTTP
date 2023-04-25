<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Resources\WizardResource;
use App\Models\Wizard;

class WizardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->input('spell')) {
            $wizards = Wizard::whereHas('spells', function (Builder $query) {
                global $request;
                $query->where('spells.id', $request->input('spell'));
            })->get();
            return WizardResource::collection($wizards);
        }
        return WizardResource::collection(Wizard::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:wizards|max:255'
        ]);

        $wizard = Wizard::create([
            'name' => $validated['name']
        ]);

        return new WizardResource($wizard);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new WizardResource(Wizard::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => "required|unique:wizards,name,{$id}|max:255"
        ]);

        $wizard = Wizard::findOrFail($id);
        $wizard->name = $validated['name'];
        $wizard->save();

        return new WizardResource($wizard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wizard = Wizard::findOrFail($id);
        $wizard->delete();
    }
}
