<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\owners;
use App\Models\Vet;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class pets extends Model
{
    use HasFactory;
    public function owner()
{
    return $this->belongsTo(owners::class, 'owner_id');
}
public function vet()
{
    return $this->belongsTo(Vet::class, 'vet_id');
}


public function pet()
{
    return $this->hasMany(appointments::class);

}
public function medical_records()
    {
        return $this->hasMany(medical_records::class);
    }
}
