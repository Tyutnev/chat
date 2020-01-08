<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;

class Message extends ActiveRecord
{
    /**
     * Сообщение еще не прочитано
     */
    const STATUS_NOT_READ = 1;
    /**
     * Сообщение прочитано
     */
    const STATUS_READ = 2;
    /**
     * Сообщение удалено
     */
    const STATUS_DELETE = 3;

    const IS_LAST = ['id_last' => 1];

    const LIMIT = 10;

    public static function tableName()
    {
        return '{{message}}';
    }

    public function rules()
    {
        return [
            ['content', 'string', 'length' => [1, 255]]
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $lastMessage = self::find()->where(self::IS_LAST)->
                                     andWhere(['id_sender' => $this->id_sender])->
                                     andWhere(['id_recipient' => $this->id_recipient])->
                                     one();

        $lastMessage->setNotLast();
        $lastMessage->save();

        parent::save($runValidation = true, $attributeNames = null);
    }

    public function setNotLast()
    {
        $this->is_last = 0;
    }

    public static function getLastMessages($pivot = null)
    {
        $state = self::find()->where(self::IS_LAST)->
                      andWhere(['id_sender' => Yii::$app->user->getId()])->
                      orWhere(['id_recipient' => Yii::$app->user->getId()])->
                      andWhere(['!=', 'status', self::STATUS_DELETE]);
        
        if($pivot) $state->andWhere(['<', 'message.id', $pivot]);

        return $state->orderBy(['id' => SORT_DESC])->limit(self::LIMIT)->all();
    }

    public static function getMessages($hash_user, $pivot = null)
    {
        $user = User::findIdByAuthKey($hash_user);
        if(!$user) return null;

        $state = self::find()->where(['id_sender' => Yii::$app->user->getId()])->
                               andWhere(['id_recipient' => $user->id])->
                               orWhere(['id_sender' => $user->id])->
                               andWhere(['id_recipient' => Yii::$app->user->getId()]);
        
        if($pivot) $state->andWhere(['<', 'message.id', $pivot]);

        return $state->orderBy(['id' => SORT_DESC])->limit(self::LIMIT)->all();
    }
}