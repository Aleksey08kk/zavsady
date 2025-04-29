<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qwestons".
 *
 * @property int $id
 * @property string|null $street_and_num
 * @property string|null $qweston
 */
class Qwestons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qwestons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['street_and_num', 'qweston'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'street_and_num' => 'Адрес',
            'qweston' => 'Сообщение',
        ];
    }

    public function qqq(){
        if($this->validate()){
            $qweston = new Qwestons();
            $qweston->street_and_num = Yii::$app->user->identity->id;
            $qweston->qweston = $this->qweston;
            $qweston->save(false);
        }
    }
}
