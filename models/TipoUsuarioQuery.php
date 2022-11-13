<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TipoUsuario]].
 *
 * @see TipoUsuario
 */
class TipoUsuarioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TipoUsuario[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TipoUsuario|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
