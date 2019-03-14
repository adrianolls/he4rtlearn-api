<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 14/03/19
 * Time: 20:22
 */

namespace App\Entities\Section;


use App\Entities\Lesson\Lesson;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name',
        'description',
        'order'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}