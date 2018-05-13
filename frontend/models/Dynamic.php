<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 20.03.2018
 * Time: 19:44
 */

namespace frontend\models;

use yii\base\DynamicModel;

class Dynamic extends DynamicModel
{
    public $category;
    private $items = [];
    private $labels = [];

    public function attributeLabels()
    {
        return $this->labels;
    }

    public function __get($name)
    {
        return $name = '';
    }

    public function loadAtr($id)
    {
        $this->items = [
            'name1' => [
                'name' => 'name1',
                'type' => 'integer',
                'label' => 'Новое имя'
            ],
            'name2' => [
                'name' => 'name2',
                'type' => 'integer',
                'label' => 'имя2'
            ]
        ];

        foreach ($this->items as $item) {
            $this->labels += array($item['name'] => $item['label']); // Массив меток
            $this->addRule($item['name'], 'integer');
            $this->__get($item['name']);
        };
    }
}