<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\owners;
use App\Models\Vet;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class pets extends Model
{
    public function owner()
{
    return $this->belongsTo(owners::class, 'owner_id');
}
public function vet()
{
    return $this->belongsTo(Vet::class, 'vet_id');
}

public function medical_records()
    {
        return $this->hasMany(medical_records::class);
    }
}
