<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\pets;
use Illuminate\Database\Eloquent\Relations\HasMany;

class owners extends Model
{
    public function pets()
{
    return $this->hasMany(Pets::class, 'owner_id');
}

}
