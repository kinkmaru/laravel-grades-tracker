<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillables = ['name', 'max_score', 'achieved_score', 'grade', 'assignment_weight', 'section_id'];
    public $timestamps = false;

    public function sections()
    {
        return $this->belongsTo(Section::class);
    }

}
