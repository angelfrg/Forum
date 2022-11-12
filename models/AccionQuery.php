<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Accion]].
 *
 * @see Accion
 */
class AccionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Accion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Accion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
