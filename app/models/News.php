<?php


namespace app\models;


use fw\core\base\Model;
use fw\libs\Helper;

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