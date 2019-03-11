<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:44 PM
 */

namespace App\Repositories\Father;


use App\Father;
use App\Repositories\Base\BaseRepository;

class FatherRepository extends BaseRepository implements IFatherRepository
{
    public function __construct(Father $model)
    {
        parent::__construct($model);
    }

    public function saveFather(array $attributes)
    {
        return $this->save($attributes);
    }

    public function updateFather($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteFather($id)
    {
        return $this->delete($id);
    }
}