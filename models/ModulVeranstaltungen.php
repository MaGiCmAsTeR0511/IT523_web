<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modul_veranstaltungen".
 *
 * @property int $id_mv
 * @property int $idkv_mv
 * @property string $von_mv
 * @property string $bis_mv
 * @property string $titel_mv
 * @property string $beschreibung_mv
 * @property int $sigid_mv
 * @property string $sigdate_mv
 *
 * @property KursVeranstaltungen $idkvMv
 * @property User $sigidMv
 */
class ModulVeranstaltungen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modul_veranstaltungen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkv_mv', 'von_mv', 'bis_mv', 'titel_mv', 'beschreibung_mv', 'sigid_mv', 'sigdate_mv'], 'required'],
            [['idkv_mv', 'sigid_mv'], 'integer'],
            [['von_mv', 'bis_mv', 'sigdate_mav'], 'safe'],
            [['beschreibung_mv'], 'string'],
            [['titel_mv'], 'string', 'max' => 80],
            [['idkv_mv'], 'exist', 'skipOnError' => true, 'targetClass' => KursVeranstaltungen::className(), 'targetAttribute' => ['idkv_mv' => 'id_kv']],
            [['sigid_mv'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sigid_mv' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mv' => Yii::t('app', 'Id Mv'),
            'idkv_mv' => Yii::t('app', 'Idkv Mv'),
            'von_mv' => Yii::t('app', 'Von Mv'),
            'bis_mv' => Yii::t('app', 'Bis Mv'),
            'titel_mv' => Yii::t('app', 'Titel Mv'),
            'beschreibung_mv' => Yii::t('app', 'Beschreibung Mv'),
            'sigid_mv' => Yii::t('app', 'Sigid Mv'),
            'sigdate_mv' => Yii::t('app', 'Sigdate Mav'),
        ];
    }

    /**
     * Gets query for [[IdkvMv]].
     *
     * @return \yii\db\ActiveQuery|KursVeranstaltungenQuery
     */
    public function getIdkvMv()
    {
        return $this->hasOne(KursVeranstaltungen::className(), ['id_kv' => 'idkv_mv']);
    }

    /**
     * Gets query for [[SigidMv]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getSigidMv()
    {
        return $this->hasOne(User::className(), ['id' => 'sigid_mv']);
    }

    /**
     * {@inheritdoc}
     * @return ModulVeranstaltungenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModulVeranstaltungenQuery(get_called_class());
    }
}
