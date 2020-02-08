<?php

namespace common\models;

use yii\db\ActiveRecord;

class Connect extends ActiveRecord
{
    public static function tableName()
    {
        return '{{connect}}';
    }

    public static function getConnect($id_user)
    {
        return self::find()->where(['id_user' => $id_user])->one();
    }

    public static function online($id_user)
    {
        $model = self::getConnect($id_user);
        $model->is_online = 1;
        $model->save();
    }

    public static function offline($id_user)
    {
        $model = self::getConnect($id_user);
        $model->is_online = 0;
        $model->exit_date = time();
        $model->save();
    }
}