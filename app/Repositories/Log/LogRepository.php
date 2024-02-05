<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/4/2019
 * Time: 1:26 PM
 */

namespace App\Repositories\Log;

use App\Log;
use App\Repositories\Base\BaseRepository;

class LogRepository extends BaseRepository implements ILogRepository
{
    public function __construct(Log $model)
    {
        parent::__construct($model);
    }

    public function saveLog(array $attributes)
    {
        return parent::save($attributes);
    }

    public function deleteLog($id)
    {
        return parent::delete($id);
    }
}
