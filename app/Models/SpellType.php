<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SpellType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function spells(): BelongsToMany
    {
        return $this->belongsToMany(Spell::class);
    }
}
