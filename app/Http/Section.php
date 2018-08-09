<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillables = ['name', 'section_weight', 'current_progress', 'goal_id'];
    public $timestamps = false;

    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
