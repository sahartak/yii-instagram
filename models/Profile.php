<?php

namespace app\models;

use app\helpers\InstagramHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property string|null $username
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 *
 * @property array $lastPosts
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profiles}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Returns array of instagram posts for the current profile
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLastPosts(): array
    {
       return InstagramHelper::getUserPosts($this->username);
    }
}
