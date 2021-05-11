<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'question_id',
        'points',
    ];

    public function getAnswerDecodedAttribute()
    {
        return json_decode($this->answer);
    }

    public function getAnswerHumanAttribute()
    {
        $ans = json_decode($this->answer);

        if (gettype($ans) == 'array') {
            return implode(', ', $ans);
        }

        if (gettype($ans) == 'object') {

            $fo = (array) $ans;

            if (gettype($fo[array_key_first($fo)]) == 'object') {
                foreach ($fo as $key => $f) {
                    $paired[$f->left] = $f->right;
                }
                return urldecode(http_build_query($paired, '', ', '));
                // return http_build_query($paired, '', ', ');
            }

            return implode(', ', $fo);
        }

        return $this->answer;
    }

    public function question()
    {
    	return $this->belongsTo(Question::class);
    }

    public function author()
    {
        return $this->morphTo('authorable');
    }
}
