<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@attachment', '/uploads/attachment/');
Yii::setAlias('@image', '/uploads/image/');
Yii::setAlias('@thumbnail', '/uploads/thumbnail/');