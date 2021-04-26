<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "signup".
 *
 * @property int $id
 * @property string $mail
 * @property string $token
 * @property string $invalid_date
 */
class Signup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'signup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mail', 'token', 'invalid_date'], 'required'],
            [['invalid_date'], 'safe'],
            [['mail', 'token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mail' => Yii::t('app', 'Mail'),
            'token' => Yii::t('app', 'Token'),
            'invalid_date' => Yii::t('app', 'Invalid Date'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SignupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SignupQuery(get_called_class());
    }
}
