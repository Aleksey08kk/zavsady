<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "history_pay".
 *
 * @property int $id
 * @property string|null $when_date
 * @property string|null $address
 * @property string|null $name
 * @property string|null $sum
 * @property string|null $messege
 */
class HistoryPay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history_pay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sum', 'when_date', 'address', 'name', 'messege'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'when_date' => 'Дата оплаты',
            'address' => 'Адрес',
            'name' => 'Имя',
            'sum' => 'Сумма',
            'messege' => 'Сообщение об оплате',
        ];
    }
}
