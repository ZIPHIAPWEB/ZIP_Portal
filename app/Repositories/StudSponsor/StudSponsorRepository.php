<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/14/2019
 * Time: 2:08 PM
 */

namespace App\Repositories\StudSponsor;

use App\Repositories\Base\BaseRepository;
use App\StudentSponsor;

class StudSponsorRepository extends BaseRepository implements IStudSponsorRepository
{
    public function __construct(StudentSponsor $model)
    {
        parent::__construct($model);
    }

    public function getStudentSponsorById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function saveStudSponsor(array $attributes)
    {
        return $this->save($attributes);
    }

    public function updateStudSponsor(array $attributes, int $id)
    {
        return $this->update($id, $attributes);
    }

    public function deleteStudSponsor(int $id)
    {
        return $this->delete($id);
    }
}
