<?php
/**
 * Created by PhpStorm.
 * User: Daniel Reis
 * Date: 3/17/2019
 * Time: 3:44 AM
 */

namespace App\FieldManagers\Challenge;


use App\FieldManager\FieldManager;

class AnswersFieldManager extends FieldManager
{
    protected $fields = [
        'challenge_id' => [
            'rules' => 'required|exists:lesson_challenges,id'
        ],
        'description' => [
            'rules' => 'string'
        ],
        'status' => [
            'rules' => 'integer'
        ]
    ];

    public function store(){
        $fields = [
            'description' => 'required',
            'status' => 'required'
        ];
        return $this->rules($fields);
    }

    public function simpleFilters()
    {
        return [
          [
              'field' => 'status',
              'type' => '='
          ]
        ];
    }
}