<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Kursanmeldungen]].
 *
 * @see Kursanmeldungen
 */
class KursanmeldungenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Kursanmeldungen[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Kursanmeldungen|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
