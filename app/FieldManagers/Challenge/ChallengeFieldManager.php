<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 16/03/19
 * Time: 16:25
 */

namespace App\FieldManagers\Challenge;


use App\FieldManager\FieldManager;

class ChallengeFieldManager extends FieldManager
{
    protected $fields = [
        'lesson_id' => [
            'rules' => 'required|integer|exists:lessons,id',
        ],
        'name' => [
            'rules' => 'string',
        ],
        'description' => [
            'rules' => 'string',
        ]
    ];

    public function index()
    {
        $fields = [
            'lesson_id' => 'required'
        ];

        return $this->rules($fields);
    }

    public function store()
    {
        $fields = [
            'name' => 'required',
            'description' => 'required'
        ];

        return $this->rules($fields);
    }

    public function simpleFilters()
    {
        return [
            [
                'field' => 'name',
                'type' => 'LIKE'
            ],
            [
                'field' => 'description',
                'type' => 'LIKE'
            ],
            [
                'field' => 'lesson_id',
                'type' => '='
            ]
        ];
    }
}