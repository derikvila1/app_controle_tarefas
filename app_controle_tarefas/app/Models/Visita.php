<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'spaceName',
        'space_id',
        'day',
        'hour',
        'peopleNumber',
        'name',
        'cellphone',
        'grade',
        'age',
        'pcdType',
        'user_id',
        'fileName',
        'project',
        'obs',
    ];

    public function user()
    {
        //belongsTo (pertence a)
        return $this->belongsTo('App\Models\User');
    }

    public function space()
    {
        return $this->hasOne('App\Models\Spaces');
    }
}