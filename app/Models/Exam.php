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

    public function creator()
    {
    	return $this->belongsTo(User::class, 'creator_id');
    }

    public function questions()
    {
    	return $this->hasMany(Question::class);
    }
}