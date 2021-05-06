<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Question;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'creator_id',
        'start',
        'end',
    ];

    protected $casts = [
        'start' => 'datetime:j.n.Y H:i',
        'end' => 'datetime:j.n.Y H:i',
    ];

    //------------------------------------------- Scopes --------------------------------------------

    /**
     * Scope a query to only include Exam Code.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByExamCode($query, $examCode)
    {
        return $query->where('code', $examCode);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function questionsWithCorrectAnswers()
    {
        return $this->hasMany(Question::class)->with('correctAnswers');
    }
}
