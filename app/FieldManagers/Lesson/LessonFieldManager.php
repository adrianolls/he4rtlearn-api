<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 14/03/19
 * Time: 21:18
 */

namespace App\FieldManagers\Lesson;


use App\FieldManager\FieldManager;

class LessonFieldManager extends FieldManager
{
    protected $fields = [
        'section_id' => [
            'rules' => 'integer|exists:sections,id',
        ],
        'name' => [
            'rules' => 'string',
        ],
        'content' => [
            'rules' => 'string',
        ],
    ];

    public function store()
    {
        $fields = [
            'section_id' => 'required',
            'name' => 'required',
            'content' => 'required'
        ];

        return $this->rules($fields);
    }

    public function simpleFilters()
    {
        return [
            'section_id',
            'name'
        ];
    }
}