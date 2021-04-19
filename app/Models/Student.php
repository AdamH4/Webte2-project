<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'school_id',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
    	return $this->name . ' ' . $this->surname;
    }

    public function answers()
    {
        return $this->morphMany(Answer::class, 'authorable');
    }
}
