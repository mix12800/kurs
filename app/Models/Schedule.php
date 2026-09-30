<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable(['doctor_id', 'date', 'start_time', 'end_time', 'office_id'])]
class Schedule extends Model
{
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

}
