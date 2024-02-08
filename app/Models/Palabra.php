<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Palabra extends Model
{
    use HasFactory;
    
    /**
     * Get all of the sinonimos for the Palabra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sinonimos(): HasMany
    {
        return $this->hasMany(Sinonimo::class, 'palabra_id', 'id');
    }

    /**
     * Get the plural of the word.
     *
     * @return string
     */
    public function getPluralAttribute()
    {
        return Str::plural($this->palabra);
    }

    /**
     * Get both singular and plural of the word.
     *
     * @return string
     */
    public function getSingularAndPluralAttribute()
    {
        return [
            $this->palabra,
            $this->plural
        ];
    }

    public function getSinonimosYPlurales()
    {
        $arrSinonimosPlurales = array_merge(
            $this->sinonimos->pluck('sinonimo')->toArray(), 
            $this->sinonimos->pluck('plural')->toArray(), 
            $this->singular_and_plural
        );

        sort($arrSinonimosPlurales);

        return $arrSinonimosPlurales;
    }
}
