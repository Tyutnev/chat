<?php

namespace common\models;

use yii\db\ActiveRecord;

class Follow extends ActiveRecord
{
    /**
     * Отправлена заявка в друзья
     */
    const STATUS_ORDER = 1;

    /**
     * Заявка в друзья отклонена
     */
    const STATUS_DECLINED = 2;

    /**
     * Являются друзьями
     */
    const STATUS_FRENDS = 3;

    public static function tableName()
    {
        return '{{follow}}';
    }

    /**
     * Получение списка заявок в друзья
     */
    public static function getOrders($id_recipient)
    {
        return self::find()->select(['user.*', 'follow.*'])->
                             innerJoin('user', 'user.id = follow.id_sender')->
                             where(['follow.status' => self::STATUS_ORDER])->
                             andWhere(['id_recipient' => $id_recipient])->
                             asArray()->
                             all();
    }
}