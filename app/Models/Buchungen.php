<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buchungen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buchungen';

    protected $fillable = [
        'start',
        'ende',
        'datum',
        'notiz',
        'raum'
    ];

    /**
     * Jede Buchung gehört zu mindesten einem Raum
     * @return BelongsTo Room
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'raum');
    }
}
