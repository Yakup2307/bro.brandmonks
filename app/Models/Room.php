<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rooms';

    /**
     * Jeder Raum kann Null bis N buchungen haben
     * Die Buchungen werden erst nach Datum, dann nach Startzeit
     * und zuletzt nach Endzeit sortiert
     * @return HasMany Buchungen
     */
    public function buchungen(): HasMany
    {
        return $this->hasMany(Buchungen::class, 'raum')
            ->orderByDesc('datum')
            ->orderByDesc('start')
            ->orderByDesc('ende');
    }
}
