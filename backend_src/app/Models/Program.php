<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
