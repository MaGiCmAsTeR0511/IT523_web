<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[KursVeranstaltungen]].
 *
 * @see KursVeranstaltungen
 */
class KursVeranstaltungenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return KursVeranstaltungen[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return KursVeranstaltungen|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
