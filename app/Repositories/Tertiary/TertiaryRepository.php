<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:47 PM
 */

namespace App\Repositories\Tertiary;


use App\Repositories\Base\BaseRepository;
use App\Tertiary;

class TertiaryRepository extends BaseRepository implements ITertiaryRepository
{
    public function __construct(Tertiary $model)
    {
        parent::__construct($model);
    }

    public function saveTertiary(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateTertiary($id, $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteTertiary($id)
    {
        return parent::delete($id);
    }
}