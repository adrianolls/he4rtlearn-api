<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 19/03/19
 * Time: 18:41
 */

namespace App\FieldManagers\Forum;


use App\FieldManager\FieldManager;

class QuestionFieldManager extends FieldManager
{
    protected $fields = [
        'lesson_id' => [
            'rules' => 'integer|required|exists:lessons,id'
        ],
        'user_id' => [
            'rules' => 'integer|exists:users,id'
        ],
        'question' => [
            'rules' => 'string'
        ],
        'approved' => [
            'rules' => 'integer'
        ]
    ];

    public function store()
    {
        $fields = [
            'question' => 'required'
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
            [
                'field' => 'question',
                'type' => 'LIKE'
            ],
            [
                'field' => 'approved',
                'type' => '='
            ],
            [
                'field' => 'lesson_id',
                'type' => '='
            ]
        ];
    }
}