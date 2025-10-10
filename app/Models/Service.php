<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'clinic_id',
        'name',
        'description',
        'price',
        'duration_minutes',
        'active',
    ];

    public function clinic() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }
}
