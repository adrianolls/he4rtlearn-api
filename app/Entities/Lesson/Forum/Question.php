<?php

namespace App\Entities\Lesson\Forum\Question;

use App\Entities\Lesson;
use App\Entities\Auth\User;
use App\Entities\Lesson\Forum\Answer;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'lesson_id',
        'user_id',
        'question',
        'approved'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
