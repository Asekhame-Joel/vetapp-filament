<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class medical_records extends Model
{
    use HasFactory;
    public function pet()
{
    return $this->belongsTo(pets::class, 'pet_id');
}

public function vet()     
{
    return $this->belongsTo(Vet::class, 'vet_id');
}
}
