<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 14/03/19
 * Time: 20:25
 */

namespace App\Entities\Lesson;


use App\Entities\Section\Section;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'section_id',
        'name',
        'content'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function challenges()
    {
        return $this->hasMany(/*TODO challenge class here*/);
    }
}