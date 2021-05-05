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

    public const types = [
        'short_answer' => 'Krátka odpoveď',
        'select_answer' => 'Výberová odpoveď',
        'pair_answer' => 'Párovacia odpoveď',
        'draw_answer' => 'Kreslená odpoveď',
        'math_answer' => 'Matematická odpoveď'
    ];

    // protected $appends = ['question_decoded'];

    public function getQuestionDecodedAttribute()
    {
        return json_decode($this->question);
    }

    public function getQuestionHumanAttribute()
    {
        if ($this->type == 'select_answer' || $this->type == 'pair_answer') {
            return $this->questionDecoded->question;
        }
        return $this->question;
    }

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
    	return $this->hasMany(Answer::class)->where('authorable_type', 'App\Models\User');
    }

    public function submittedAnswers()
    {
    	return $this->hasMany(Answer::class)->where('authorable_type', 'App\Models\Student');
    }
}
