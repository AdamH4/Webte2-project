<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;
use App\Models\Answer;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'exam_id',
        'question',
    ];

    public function exam()
    {
    	return $this->belongsTo(Exam::class);
    }

    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }

    public function correctAnswers()
    {
    	return $this->hasMany(Answer::class)->where('author_type' == 'App\User');
    }

    public function submittedAnswers()
    {
    	return $this->hasMany(Answer::class)->where('author_type' == 'App\Student');
    }
}
