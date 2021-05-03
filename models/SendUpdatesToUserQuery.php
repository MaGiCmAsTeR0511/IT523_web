<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SendUpdatesToUser]].
 *
 * @see SendUpdatesToUser
 */
class SendUpdatesToUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SendUpdatesToUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SendUpdatesToUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
