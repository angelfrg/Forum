<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SuscripcionCategoria]].
 *
 * @see SuscripcionCategoria
 */
class SuscripcionCategoriaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SuscripcionCategoria[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SuscripcionCategoria|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
