<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'available', 'schedules'];

    public function visita()
    {
        //belongsTo (pertence a)
        return $this->belongsTo('App\Models\Visita');
    }
}