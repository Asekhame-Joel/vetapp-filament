<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class medical_records extends Model
{
    public function pet()
{
    return $this->belongsTo(pets::class);
}

public function vet()     
{
    return $this->belongsTo(users::class, 'vet_id');
}

}
