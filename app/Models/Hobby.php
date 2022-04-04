<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $table = 'hobbies';

    protected $fillable = ['name', 'slug'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
