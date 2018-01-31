<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 21.09.2017
 * Time: 13:14
 */

namespace common\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;


class StatusBehavior extends Behavior
{
    public $status;
    public $value;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'createdStatus',
        ];
    }

    public function createdStatus($event)
    {
        $this->owner->status = $this->value;
    }

}