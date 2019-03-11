<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/4/2019
 * Time: 1:26 PM
 */

namespace App\Repositories\Log;


interface ILogRepository
{
    public function saveLog(array $attributes);
    public function deleteLog($id);
}