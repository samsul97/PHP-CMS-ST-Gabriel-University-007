<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property int $user_id
 * @property string $reply_type
 * @property string|null $ask
 * @property string|null $answer
 * @property string|null $message
 * @property string|null $ip_address
 * @property string|null $timestamp
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_conversation', 'user_id', 'reply_type'], 'required'],
            [['user_id'], 'integer'],
            [['message'], 'string'],
            [['timestamp'], 'safe'],
            [['group_conversation'], 'string', 'max' => 16],
            [['reply_type', 'ask', 'answer'], 'string', 'max' => 255],
            [['ip_address'], 'string', 'max' => 50],
            [['group_conversation'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_conversation' => 'Group Conversation',
            'user_id' => 'User ID',
            'reply_type' => 'Reply Type',
            'ask' => 'Ask',
            'answer' => 'Answer',
            'message' => 'Message',
            'ip_address' => 'Ip Address',
            'timestamp' => 'Timestamp',
        ];
    }
}
