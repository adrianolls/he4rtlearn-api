<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 16/03/19
 * Time: 23:08
 */

namespace App\Entities\Lesson\Challenge;


use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'lesson_challenges_answers';

    protected $fillable = [
        'challenge_id',
        'description',
        'status'
    ];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}