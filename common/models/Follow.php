<?php

namespace common\models;

use Yii;
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

    /**
     * Количества элементов в выборке списка друзей
     */
    const LIMIT_LIST_FRENDS = 10;

    public static function tableName()
    {
        return '{{follow}}';
    }

    /**
     * Получение списка заявок в друзья
     * @return array
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

    /**
     * @return object
     */
    public static function getOrderById($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * @return array
     */
    public static function getFriends()
    {
        $currentUser = Yii::$app->user->getId();

        $friendsList = self::find()->where(['id_sender' => $currentUser])->
                            orWhere(['id_recipient' => $currentUser])->
                            andWhere(['status' => self::STATUS_FRENDS])->
                            limit(self::LIMIT_LIST_FRENDS)->
                            all();
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        $messageList = [
            self::STATUS_ORDER => 'Заявка в друзья отправлена',
            self::STATUS_DECLINED => 'Пользователь отклонил заявку',
            self::STATUS_FRENDS => 'У вас в друзьях'
        ];

        return $messageList[$this->status];
    }
}