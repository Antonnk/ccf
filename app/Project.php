<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'details'];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
