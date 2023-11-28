<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:46 PM
 */

namespace App\Repositories\Secondary;

use App\Repositories\Base\BaseRepository;
use App\Secondary;

class SecondaryRepository extends BaseRepository implements ISecondaryRepository
{
    public function __construct(Secondary $model)
    {
        parent::__construct($model);
    }

    public function saveSecondary(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateSecondary($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteSecondary($id)
    {
        return parent::delete($id);
    }
}
