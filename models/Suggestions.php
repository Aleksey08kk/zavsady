<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suggestions".
 *
 * @property int $id
 * @property string|null $address
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $suggestion
 * @property string|null $status
 * @property string|null $detailed
 * @property string|null $comment
 * @property string|null $cancelled_reason
 * @property int|null $in_process
 * @property int|null $postponed
 * @property string|null $postponed_reason
 * @property int|null $completed
 * @property int|null $modification
 * @property string|null $date_last_update
 * @property string|null $date_create
 */
class Suggestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suggestions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['in_process', 'postponed', 'completed', 'modification'], 'integer'],
            [['date_last_update', 'date_create'], 'safe'],
            [['address', 'comment', 'detailed', 'status', 'name', 'phone', 'suggestion', 'cancelled_reason', 'postponed_reason'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Адрес',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'suggestion' => 'Предложение',
            'status' => 'Статус',
            'detailed' => 'Подробнее',
            'comment' => 'Комментарий',
            'cancelled_reason' => 'Причина отклонения',
            'in_process' => 'В процессе',
            'postponed' => 'Отложенный',
            'postponed_reason' => 'Причина отложения',
            'completed' => 'Готово',
            'modification' => 'Модификация',
            'date_last_update' => 'Дата последнего обновления',
            'date_create' => 'Дата создания',
        ];
    }
}


