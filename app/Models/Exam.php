<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Question;
use Carbon\Carbon;

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

    // commended for now
    // protected $casts = [
    //     'start' => 'datetime:j.n.Y H:i',
    //     'end' => 'datetime:j.n.Y H:i',
    // ];

    protected $appends = ['start_human', 'end_human'];

    public function getStartHumanAttribute()
    {
        return Carbon::create($this->start)->format('j.n.Y H:i');
    }

    public function getEndHumanAttribute()
    {
        return Carbon::create($this->end)->format('j.n.Y H:i');
    }

    public function getStartCarbonAttribute()
    {
        return Carbon::create($this->start);
    }

    public function getEndCarbonAttribute()
    {
        return Carbon::create($this->end);
    }

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

    //------------------------------------------- Realtionships --------------------------------------------

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'exam_code', 'code');
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
