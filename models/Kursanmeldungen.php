<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kursanmeldungen".
 *
 * @property int $id_ka
 * @property string $iddc_ka
 * @property int $idkv_ka
 * @property int|null $deleted_ka
 *
 * @property KursVeranstaltungen $idkvKa
 */
class Kursanmeldungen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kursanmeldungen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddc_ka', 'idkv_ka'], 'required'],
            [['idkv_ka', 'deleted_ka'], 'integer'],
            [['iddc_ka'], 'string', 'max' => 255],
            [['idkv_ka'], 'exist', 'skipOnError' => true, 'targetClass' => KursVeranstaltungen::className(), 'targetAttribute' => ['idkv_ka' => 'id_kv']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ka' => Yii::t('app', 'Id Ka'),
            'iddc_ka' => Yii::t('app', 'Iddc Ka'),
            'idkv_ka' => Yii::t('app', 'Idkv Ka'),
            'deleted_ka' => Yii::t('app', 'Deleted Ka'),
        ];
    }

    /**
     * Gets query for [[IdkvKa]].
     *
     * @return \yii\db\ActiveQuery|KursVeranstaltungenQuery
     */
    public function getIdkvKa()
    {
        return $this->hasOne(KursVeranstaltungen::className(), ['id_kv' => 'idkv_ka']);
    }

    /**
     * {@inheritdoc}
     * @return KursanmeldungenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KursanmeldungenQuery(get_called_class());
    }
}
