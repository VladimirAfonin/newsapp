<?php


namespace app\models;


use fw\core\base\Model;

class News extends Model
{
    public $attributes = [
        'text' => '',
    ];

    public $rules = [
        'required' => [
            ['text'],
        ],
    ];

}