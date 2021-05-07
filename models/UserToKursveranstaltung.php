<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_to_kursveranstaltung".
 *
 * @property int $id_utkv
 * @property int $iduser_utkv
 * @property int $idkv_utkv
 *
 * @property KursVeranstaltungen $idkvUtkv
 * @property User $iduserUtkv
 */
class UserToKursveranstaltung extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_to_kursveranstaltung';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iduser_utkv', 'idkv_utkv'], 'required'],
            [['iduser_utkv', 'idkv_utkv'], 'integer'],
            [['idkv_utkv'], 'exist', 'skipOnError' => true, 'targetClass' => KursVeranstaltungen::class, 'targetAttribute' => ['idkv_utkv' => 'id_kv']],
            [['iduser_utkv'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['iduser_utkv' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_utkv' => Yii::t('app', 'Id Utkv'),
            'iduser_utkv' => Yii::t('app', 'Iduser Utkv'),
            'idkv_utkv' => Yii::t('app', 'Idkv Utkv'),
        ];
    }

    /**
     * Gets query for [[IdkvUtkv]].
     *
     * @return \yii\db\ActiveQuery|KursVeranstaltungenQuery
     */
    public function getIdkvUtkv()
    {
        return $this->hasOne(KursVeranstaltungen::className(), ['id_kv' => 'idkv_utkv']);
    }

    /**
     * Gets query for [[IduserUtkv]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getIduserUtkv()
    {
        return $this->hasOne(User::className(), ['id' => 'iduser_utkv']);
    }

    /**
     * {@inheritdoc}
     * @return UserToKursveranstaltungQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserToKursveranstaltungQuery(get_called_class());
    }
}
