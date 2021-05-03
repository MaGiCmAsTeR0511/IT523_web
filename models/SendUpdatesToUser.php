<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "send_updates_to_user".
 *
 * @property int $id_sutu
 * @property int $idkv_sutu
 * @property string|null $send_sutu
 *
 * @property KursVeranstaltungen $idkvSutu
 */
class SendUpdatesToUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'send_updates_to_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkv_sutu'], 'required'],
            [['idkv_sutu'], 'integer'],
            [['send_sutu'], 'safe'],
            [['idkv_sutu'], 'exist', 'skipOnError' => true, 'targetClass' => KursVeranstaltungen::className(), 'targetAttribute' => ['idkv_sutu' => 'id_kv']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sutu' => Yii::t('app', 'Id Sutu'),
            'idkv_sutu' => Yii::t('app', 'Idkv Sutu'),
            'send_sutu' => Yii::t('app', 'Send Sutu'),
        ];
    }

    /**
     * Gets query for [[IdkvSutu]].
     *
     * @return \yii\db\ActiveQuery|KursVeranstaltungenQuery
     */
    public function getIdkvSutu()
    {
        return $this->hasOne(KursVeranstaltungen::className(), ['id_kv' => 'idkv_sutu']);
    }

    /**
     * {@inheritdoc}
     * @return SendUpdatesToUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SendUpdatesToUserQuery(get_called_class());
    }
}
