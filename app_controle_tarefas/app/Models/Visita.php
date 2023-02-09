<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;
    protected $fillable = [ 'id', 'address', 'day', 'hour','participantes','name','série','idade','confirmed','solicitante','solicitante'];
    
    public function user() {
        //belongsTo (pertence a)
        return $this->belongsTo('App\Models\User');
    }
}
