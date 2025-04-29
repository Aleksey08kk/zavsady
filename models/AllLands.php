<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "all_lands".
 *
 * @property int $id
 * @property string|null $street_and_num
 * @property string|null $name_owner
 * @property string|null $email
 * @property string|null $debt_str
 * @property int|null $dop_accrual
 * @property int|null $tel
 * @property string|null $photo
 * @property int|null $date
 * @property int|null $how_much_sotok
 * @property string|null $accrual
 * @property string|null $dop_two_accrual
 */
class AllLands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'all_lands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tel', 'date', 'how_much_sotok'], 'integer'],
            [['street_and_num', 'name_owner', 'email', 'debt_str', 'photo', 'accrual', 'dop_accrual', 'dop_two_accrual'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'street_and_num' => 'Улица и номер участка',
            'name_owner' => 'Имя собственника',
            'email' => 'Эл. Почта',
            'debt_str' => 'Долг_str',
            'dop_accrual' => 'Дополнительный взнос 24-25',
            'tel' => 'Телефон',
            'photo' => 'Фото',
            'date' => 'Дата создания',
            'how_much_sotok' => 'кв.м.',
            'accrual' => 'Начислено взносов',
            'dop_two_accrual' => 'Второй доп взнос'
        ];
    }


    public function saveAllLands()
    {
            return $this->save(false);
    }


    public function addLand(): bool
    {
        $userModel = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        $allLandsModel = AllLands::find()->where(['street_and_num' => $this->street_and_num])->one();
        if ($allLandsModel->street_and_num == $this->street_and_num) {
            $allLandsModel->email = $userModel->email;
            $allLandsModel->name_owner = $userModel->name . $userModel->last_name;
            $allLandsModel->save(false);
        }return false;
    }

}
