<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "adminuser".
 *
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $email
 * @property string $profile
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 *
 * @property Post[] $posts
 */
class Adminuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adminuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nickname', 'password', 'email', 'password_hash', 'auth_key'], 'required'],
            [['profile'], 'string'],
            [['username', 'nickname', 'password', 'email'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'nickname' => 'Nickname',
            'password' => 'Password',
            'email' => 'Email',
            'profile' => 'Profile',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['author_id' => 'id']);
    }

    public static function getUsernameArray()
    {
        return Adminuser::find()
            ->select(['nickname', 'id'])
            ->indexBy('id')
            ->column();
    }
}
