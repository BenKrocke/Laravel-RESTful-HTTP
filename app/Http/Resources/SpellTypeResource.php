<?php

namespace App\Http\Resources;

use App\Http\Controllers\SpellController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpellTypeResource extends JsonResource
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
                'type' => $this->type
            ],
            'links' => [
                'self' => action([SpellController::class, 'show'], ['spell' => $this->id]),
                'collection' => action([SpellController::class, 'index']),
                'spells' => action([SpellController::class, 'index']) . '?spell_type=' . $this->id
            ]
        ];
    }
}
