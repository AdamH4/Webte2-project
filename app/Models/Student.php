<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Answer;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'in-exam';

    protected $fillable = [
        'name',
        'surname',
        'ais_id',
        'is_active',
        'exam_code'
    ];

    public const WRITING = 'writing';
    public const LEFT = 'left';
    public const DONE = 'done';

    public const STATUSES = [
        self::WRITING,
        self::LEFT,
        self::DONE,
    ];

    protected $appends = ['full_name', 'status'];

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getStatusAttribute()
    {
        return __('students.constants.' . $this->is_active . '');
    }

    //------------------------------------------ Scopes ------------------------------------

    /**
     * Scope a query to only include student AIS ID.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAis($query, $aisId)
    {
        return $query->where('ais_id', $aisId);
    }

    /**
     * Scope a query to only include Exam Code.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByExamCode($query, $examCode)
    {
        return $query->where('exam_code', $examCode);
    }

    /**
     * Scope a query to only include Activity.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('is_active', $status);
    }

    //------------------------------------------- Methods -------------------------

    public function isInCorrectExam(Exam $exam)
    {
        return $this->exam_code == $exam->code;
    }

    public function isWritingExam()
    {
        return ($this->is_active == self::WRITING || $this->is_active == self::LEFT);
    }

    //------------------------------------------- Relationships -------------------------

    public function answers()
    {
        return $this->morphMany(Answer::class, 'authorable');
    }

    public function exam()
    {
        $this->belongsTo(Exam::class, 'code', 'exam_code');
    }
}
