<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "send_updates_to_dc".
 *
 * @property int $id_sudc
 * @property int $idkv_sudc
 * @property string|null $send_sudc
 *
 * @property KursVeranstaltungen $idkvSudc
 */
class SendUpdatesToDc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'send_updates_to_dc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkv_sudc'], 'required'],
            [['idkv_sudc'], 'integer'],
            [['send_sudc'], 'safe'],
            [['idkv_sudc'], 'exist', 'skipOnError' => true, 'targetClass' => KursVeranstaltungen::className(), 'targetAttribute' => ['idkv_sudc' => 'id_kv']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sudc' => Yii::t('app', 'Id Sudc'),
            'idkv_sudc' => Yii::t('app', 'Idkv Sudc'),
            'send_sudc' => Yii::t('app', 'Send Sudc'),
        ];
    }

    /**
     * Gets query for [[IdkvSudc]].
     *
     * @return \yii\db\ActiveQuery|KursVeranstaltungenQuery
     */
    public function getIdkvSudc()
    {
        return $this->hasOne(KursVeranstaltungen::className(), ['id_kv' => 'idkv_sudc']);
    }

    /**
     * {@inheritdoc}
     * @return SendUpdatesToDcQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SendUpdatesToDcQuery(get_called_class());
    }
}
