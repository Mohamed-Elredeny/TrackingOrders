<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Supporter extends Authenticatable
{
    protected $guard = 'supporter';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'status',
        'country_id'
    ];
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
