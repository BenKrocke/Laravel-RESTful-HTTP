<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\WizardController;

class WizardResource extends JsonResource
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
                'spells' => str_contains($request->query('embed'), 'spells') ? SpellResource::collection($this->spells) : $this->spells->pluck('id')
            ],
            'links' => [
                'self' => action([WizardController::class, 'show'], ['wizard' => $this->id]),
                'collection' => action([WizardController::class, 'index']),
                'embed' => action([WizardController::class, 'show'], ['wizard' => $this->id]) . "?embed=spells"
            ]
        ];
    }
}
