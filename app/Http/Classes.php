<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillables = ['name', 'target_grade', 'actual_grade'];
    public $timestamps = false;

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}
