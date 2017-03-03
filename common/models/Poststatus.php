<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "poststatus".
 *
 * @property integer $id
 * @property string $name
 * @property integer $position
 *
 * @property Post[] $posts
 */
class Poststatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poststatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'required'],
            [['position'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['status' => 'id']);
    }

    public static function getPostStatusArray()
    {
        /*
        //第一种方法
        $psObjs = Poststatus::find()->all();
        $allStatus = ArrayHelper::map($psObjs, 'id', 'name');

        // 第二种方法
        $psArray = Yii::$app->db->createCommand('select id,name from poststatus')->queryAll();
        $allStatus = ArrayHelper::map($psArray, 'id', 'name');

        // 第三种方法
        $allStatus = (new \yii\db\Query())
            ->select(['name', 'id'])
            ->from('poststatus')
            ->indexBy('id')
            ->column();

        // 第四种方法
        $allStatus = Poststatus::find()
            ->select(['name', 'id'])
            ->orderBy('position')
            ->indexBy('id')
            ->column();
        */
        return Poststatus::find()
            ->select(['name', 'id'])
            ->orderBy('position')
            ->indexBy('id')
            ->column();
    }
}
