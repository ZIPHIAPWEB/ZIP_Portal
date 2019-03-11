<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 8:02 PM
 */

namespace App\Repositories\Experience;


use App\Experience;
use App\Repositories\Base\BaseRepository;

class ExperienceRepository extends BaseRepository implements IExperienceRepository
{
    public function __construct(Experience $model)
    {
        parent::__construct($model);
    }

    public function saveExperience(array $attributes)
    {
        $attributes['end_date'] = ($attributes['end_date'] == null) ? 'Present' : $attributes['end_date'];
        return $this->save($attributes);
    }

    public function updateExperience($id, array $attributes)
    {
        return $this->update($id, $attributes);
    }

    public function deleteExperience($id)
    {
        return $this->delete($id);
    }
}