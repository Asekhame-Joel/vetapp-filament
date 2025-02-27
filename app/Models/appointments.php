<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointments extends Model
{
    use HasFactory;
    public function pet()
{
    return $this->belongsTo(pets::class);
}
public function user()
{
    return $this->belongsTo(users::class);
}

public function vet()
{
    return $this->belongsTo(Vet::class, 'vet_id');
}
public function owner()
{
    return $this->belongsTo(owners::class);
}

}
