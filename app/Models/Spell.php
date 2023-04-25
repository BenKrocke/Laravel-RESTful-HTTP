<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Spell extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'damage', 'spell_type_id'];

    public function wizards(): BelongsToMany
    {
        return $this->belongsToMany(Wizard::class);
    }

    public function spell_type(): BelongsTo
    {
        return $this->belongsTo(SpellType::class);
    }
}
