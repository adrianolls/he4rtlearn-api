<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 14/03/19
 * Time: 20:32
 */

namespace App\FieldManagers\Section;


use App\FieldManager\FieldManager;

class SectionFieldManager extends FieldManager
{
    protected $fields = [
        'name' => [
            'rules' => 'string',
        ],
        'description' => [
            'rules' => 'text',
        ],
        'order' => [
            'rules' => 'integer',
        ]
    ];

    public function store()
    {
        $fields = [
            'name' => 'required',
            'description' => 'required',
            'order' => 'required'
        ];

        return $this->rules($fields);
    }

    public function simpleFilters()
    {
        return ['name'];
    }
}