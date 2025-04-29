<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uslugi".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $usluga
 * @property int|null $active
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $viber
 * @property string|null $photo
 * @property int|null $date
 */
class Uslugi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uslugi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'date'], 'integer'],
            [['name', 'usluga', 'phone', 'viber', 'photo', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usluga' => 'Услуга',
            'name' => 'Имя',
            'active' => 'Принимаю заказы',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'viber' => 'Viber',
            'photo' => 'Photo',
            'date' => 'Date',
        ];
    }
}
