<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 01/06/19
 * Time: 15:42
 */

namespace App\Repositories;


abstract class RepoBase
{
    abstract function getModel();

    public function all()
    {
        return $this->getModel()->all();
    }

    public function getModelById($id)
    {
        return $this->getModel()->where('id',$id)->first();
    }

    public function getModelWithRelationsById($id,$relation)
    {
        if (is_string($relation)) {
            return $this->getModel()->with([$relation])->where('id',$id)->first();
        }

        return $this->getModel()->with($relation)->where('id',$id)->first();
    }

}
