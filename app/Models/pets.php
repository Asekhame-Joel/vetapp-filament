<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\owners;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class pets extends Model
{
    public function owner()
{
    return $this->belongsTo(owners::class, 'owner_id');
}

}
