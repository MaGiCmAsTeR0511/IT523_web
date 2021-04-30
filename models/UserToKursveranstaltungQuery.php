<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserToKursveranstaltung]].
 *
 * @see UserToKursveranstaltung
 */
class UserToKursveranstaltungQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserToKursveranstaltung[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserToKursveranstaltung|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
