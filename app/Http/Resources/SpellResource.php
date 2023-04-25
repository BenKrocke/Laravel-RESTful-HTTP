<?php

namespace App\Http\Resources;

use App\Http\Controllers\SpellController;
use App\Http\Controllers\WizardController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpellResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'spell_type' => str_contains($request->query('embed'), 'spell_type') ? new SpellTypeResource($this->spell_type) : $this->spell_type->id,
                'damage' => $this->damage
            ],
            'links' => [
                'self' => action([SpellController::class, 'show'], ['spell' => $this->id]),
                'collection' => action([SpellController::class, 'index']),
                'wizards' => action([WizardController::class, 'index']) . '?spell=' . $this->id,
                'embed' => action([SpellController::class, 'show'], ['spell' => $this->id]) . "?embed=spell_type"
            ]
        ];
    }
}
