<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 17/03/19
 * Time: 20:21
 */

namespace App\Entities\Lesson\Forum;


use App\Entities\Auth\User;
use App\Entities\Lesson\Lesson;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'lesson_questions';

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