<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;

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
    public static function getFriends($pivot = null)
    {
        $currentUser = Yii::$app->user->getId();

        $followList = self::find()->where(['id_sender' => $currentUser])->
                            orWhere(['id_recipient' => $currentUser])->
                            andWhere(['status' => self::STATUS_FRENDS])->
                            limit(self::LIMIT_LIST_FRENDS);

        if($pivot) $followList->where(['id', '<', $pivot]);
        
        $followList = $followList->orderBy(['id' => SORT_DESC])->all();

        $friendList = [];
        foreach($followList as $follow)
        {
            $friendList[] = $follow->getInfoAboutUser(true);
        }

        return $friendList;
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

    public function getInfoAboutUser($asArray = false)
    {
        if($this->id_sender != Yii::$app->user->getId())
        {
            $target = $this->id_sender;
        }
        else
        {
            $target = $this->id_recipient;
        }

        return User::findById($target, $asArray);
    }
}