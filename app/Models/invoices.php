<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class invoices extends Model
{
    public function appointment()
{
    return $this->belongsTo(appointments::class);
}

}
