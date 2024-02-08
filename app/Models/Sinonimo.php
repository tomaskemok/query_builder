<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Sinonimo extends Model
{
    use HasFactory;

    /**
     * Get the palabra that owns the Sinonimo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function palabra(): BelongsTo
    {
        return $this->belongsTo(Palabra::class, 'palabra_id', 'id');
    }
  
    /**
     * Get the plural of the word.
     *
     * @return string
     */
    public function getPluralAttribute()
    {
        return Str::plural($this->sinonimo);
    }

    /**
     * Get both singular and plural of the word.
     *
     * @return string
     */
    public function getSingularAndPluralAttribute()
    {
        return [
            $this->sinonimo,
            $this->plural
        ];
    }
}
