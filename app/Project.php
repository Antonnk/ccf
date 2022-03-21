<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'details'];

    public function getTimeSpentAttribute(): int
    {
        return $this->entries()
            ->where('end', '!=', null)
            ->get()
            ->sum(function (Entry $entry) {
                return strtotime($entry->end) - strtotime($entry->start);
            });
    }

    public function getIsRunningAttribute(): bool
    {
        return $this->entries()->where('end', null)->exists();
    }

    public function entries()
    {
        return $this->hasMany(Entry::class)->orderBy('created_at', 'DESC');
    }
}
