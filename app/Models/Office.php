<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['num', 'doctor_id'])]

class Office extends Model
{
    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
