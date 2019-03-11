<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:46 PM
 */

namespace App\Repositories\Primary;


use App\Primary;
use App\Repositories\Base\BaseRepository;

class PrimaryRepository extends BaseRepository implements IPrimaryRepository
{
    public function __construct(Primary $model)
    {
        parent::__construct($model);
    }

    public function savePrimary(array $attributes)
    {
        return $this->save($attributes);
    }

    public function updatePrimary($id, array $attributes)
    {
        return $this->update($id, $attributes);
    }

    public function deletePrimary($id)
    {
        return $this->delete($id);
    }
}