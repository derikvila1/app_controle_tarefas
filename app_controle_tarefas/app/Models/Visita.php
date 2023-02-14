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
    'spaceCode',
    'day',
    'hour',
    'peopleNumber',
    'name',
    'grade',
    'age',
    'pcd',
    'pcdType',
    'requesterId'
    ];
    
    public function user() {
        //belongsTo (pertence a)
        return $this->belongsTo('App\Models\User');
    }
}
