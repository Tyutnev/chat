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

    const IS_LAST = ['is_last' => 1];

    const NOT_DELETE = ['!=', 'message.status', self::STATUS_DELETE];

    const LIMIT = 10;

    public static function tableName()
    {
        return '{{message}}';
    }

    public function rules()
    {
        return [
            ['content', 'required'],
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
        $state = self::find()->where(['id_sender' => Yii::$app->user->getId()])->
                               orWhere(['id_recipient' => Yii::$app->user->getId()])->
                               andWhere(self::IS_LAST)->
                               andWhere(self::NOT_DELETE);
        
        if($pivot) $state->andWhere(['<', 'message.id', $pivot]);

        $lastMessages = $state->orderBy(['message.id' => SORT_DESC])->
                       limit(self::LIMIT)->
                       asArray()->
                       all();

        foreach($lastMessages as &$lastMessage)
        {
            if($lastMessage['id_sender'] != Yii::$app->user->getId())
            {
                $lastMessage['user'] = User::findById($lastMessage['id_sender'], true);
                continue;
            }
            $lastMessage['user'] = User::findById($lastMessage['id_recipient'], true);
        }

        return $lastMessages;
    }

    public static function getMessages($hash, $pivot = null)
    {
        $id = User::findIdByMessageHash($hash);
        if(!$id) return null;

        $state = self::find()->where(['id_sender' => Yii::$app->user->getId()])->
                               orWhere(['id_sender' => $id])->
                               andWhere(['id_recipient' => Yii::$app->user->getId()])->
                               orWhere(['id_recipient' => $id])->
                               andWhere(self::NOT_DELETE);
        
        if($pivot) $state->andWhere(['<', 'message.id', $pivot]);

        return $state->limit(self::LIMIT)->
                       asArray()->
                       all();
    }
}