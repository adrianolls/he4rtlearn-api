<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 17/03/19
 * Time: 20:09
 */

namespace App\FieldManagers\Forum;


use App\FieldManager\FieldManager;

class AnswerFieldManager extends FieldManager
{
    protected $fields = [
        'question_id' => [
            'rules' => 'required|exists:lesson_questions,id'
        ],
        'user_id' => [
            'rules' => 'exists:users,id'
        ],
        'description' => [
            'rules' => 'string'
        ]
    ];

    public function store()
    {
        $fields = [
            'user_id' => 'required',
            'description' => 'required'
        ];
        return $this->rules($fields);
    }

    public function simpleFilters()
    {
        return [
            [
                'field' => 'user_id',
                'type' => '='
            ],
        ];
    }
}