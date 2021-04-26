<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Signup]].
 *
 * @see Signup
 */
class SignupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Signup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Signup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
