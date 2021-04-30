<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SendUpdatesToDc]].
 *
 * @see SendUpdatesToDc
 */
class SendUpdatesToDcQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SendUpdatesToDc[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SendUpdatesToDc|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
