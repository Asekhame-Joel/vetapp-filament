<?php

namespace App\Models;
use App\Casts\MoneyCast;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class invoices extends Model
{
    use HasFactory;
    protected $casts = [
        'amount' => MoneyCast::class,
    ];
 
    public function appointments()
{
    return $this->belongsTo(appointments::class, 'appointment_id');
}
public function owner()
{
    return $this->belongsTo(owners::class, 'owner_id');
}

}
