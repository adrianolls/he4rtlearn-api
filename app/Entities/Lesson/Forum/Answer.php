<?php

namespace App\Entities\Lesson\Forum;


use App\Entities\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'lesson_question_answers';
  
    protected $fillable = [
        'question_id',
        'user_id',
        'description'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

