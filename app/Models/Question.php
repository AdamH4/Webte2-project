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
        'points',
    ];

    public const types = [
        'short_answer' => 'Krátka odpoveď',
        'select_answer' => 'Výberová odpoveď',
        'pair_answer' => 'Párovacia odpoveď',
        'draw_answer' => 'Kreslená odpoveď',
        'math_answer' => 'Matematická odpoveď'
    ];

    public const SHORT_ANSWER = 'short_answer';
    public const SELECT_ANSWER = 'select_answer';
    public const PAIR_ANSWER = 'pair_answer';
    public const DRAW_ANSWER = 'draw_answer';
    public const MATH_ANSWER = 'math_answer';

    // protected $appends = ['question_decoded'];

    public function getQuestionDecodedAttribute()
    {
        return json_decode($this->question);
    }

    public function getQuestionHumanAttribute()
    {
        return $this->questionDecoded->question;
    }

    public function getLeftsideOptionsStr()
    {
        return implode(', ', (array) $this->questionDecoded->options->left);
    }

    public function getRightsideOptionsStr()
    {
        return implode(', ', (array) $this->questionDecoded->options->right);
    }

    public function getSelectOptionsStr()
    {
        return implode(', ', (array) $this->questionDecoded->options);
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
