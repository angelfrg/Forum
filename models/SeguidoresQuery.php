<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Seguidores]].
 *
 * @see Seguidores
 */
class SeguidoresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Seguidores[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Seguidores|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
