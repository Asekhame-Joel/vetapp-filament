<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    // protected $fillable = ['name', 'email', 'phone', 'specialization'];

    public function pets()
    {
        return $this->hasMany(pets::class);
    }
    public function appointments()
    {
        return $this->hasMany(appointments::class);
    }
    public function medical_records(){
        return $this->hasMany(medical_records::class, 'vet_id');

    }

}
