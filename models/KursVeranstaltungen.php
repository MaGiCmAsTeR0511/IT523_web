<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kurs_veranstaltungen".
 *
 * @property int $id_kv
 * @property string $titel_kv
 * @property string $von_kv
 * @property string $bis_kv
 * @property string $beschreibung_kv
 * @property string $sigdate_kv
 * @property int $sigid_kv
 * @property int $deleted_kv
 *
 * @property User $sigidKv
 * @property Kursanmeldungen[] $kursanmeldungens
 * @property ModulVeranstaltungen[] $modulVeranstaltungens
 * @property SendUpdatesToDc[] $sendUpdatesToDcs
 * @property UserToKursveranstaltung[] $userToKursveranstaltungs
 */
class KursVeranstaltungen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kurs_veranstaltungen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titel_kv', 'von_kv', 'bis_kv', 'beschreibung_kv', 'sigdate_kv', 'sigid_kv', 'deleted_kv'], 'required'],
            [['von_kv', 'bis_kv', 'sigdate_kv'], 'safe'],
            [['beschreibung_kv'], 'string'],
            [['sigid_kv', 'deleted_kv'], 'integer'],
            [['titel_kv'], 'string', 'max' => 45],
            [['sigid_kv'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sigid_kv' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kv' => Yii::t('app', 'Id Kv'),
            'titel_kv' => Yii::t('app', 'Titel Kv'),
            'von_kv' => Yii::t('app', 'Von Kv'),
            'bis_kv' => Yii::t('app', 'Bis Kv'),
            'beschreibung_kv' => Yii::t('app', 'Beschreibung Kv'),
            'sigdate_kv' => Yii::t('app', 'Sigdate Kv'),
            'sigid_kv' => Yii::t('app', 'Sigid Kv'),
            'deleted_kv' => Yii::t('app', 'Deleted Kv'),
        ];
    }

    /**
     * Gets query for [[SigidKv]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getSigidKv()
    {
        return $this->hasOne(User::className(), ['id' => 'sigid_kv']);
    }

    /**
     * Gets query for [[Kursanmeldungens]].
     *
     * @return \yii\db\ActiveQuery|KursanmeldungenQuery
     */
    public function getKursanmeldungens()
    {
        return $this->hasMany(Kursanmeldungen::className(), ['idkv_ka' => 'id_kv']);
    }

    /**
     * Gets query for [[ModulVeranstaltungens]].
     *
     * @return \yii\db\ActiveQuery|ModulVeranstaltungenQuery
     */
    public function getModulVeranstaltungens()
    {
        return $this->hasMany(ModulVeranstaltungen::className(), ['idkv_mv' => 'id_kv']);
    }

    /**
     * Gets query for [[SendUpdatesToDcs]].
     *
     * @return \yii\db\ActiveQuery|SendUpdatesToDcQuery
     */
    public function getSendUpdatesToDcs()
    {
        return $this->hasMany(SendUpdatesToDc::className(), ['idkv_sudc' => 'id_kv']);
    }

    /**
     * Gets query for [[UserToKursveranstaltungs]].
     *
     * @return \yii\db\ActiveQuery|UserToKursveranstaltungQuery
     */
    public function getUserToKursveranstaltungs()
    {
        return $this->hasMany(UserToKursveranstaltung::className(), ['idkv_utkv' => 'id_kv']);
    }

    /**
     * {@inheritdoc}
     * @return KursVeranstaltungenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KursVeranstaltungenQuery(get_called_class());
    }
}
