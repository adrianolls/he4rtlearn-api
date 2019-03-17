<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 16/03/19
 * Time: 16:10
 */

namespace App\Entities\Lesson\Challenge;


use App\Entities\Lesson\Lesson;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'lesson_challenges';

    protected $fillable = [
        'lesson_id',
        'name',
        'description'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}