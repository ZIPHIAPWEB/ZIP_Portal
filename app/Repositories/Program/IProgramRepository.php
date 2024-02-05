<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/28/2019
 * Time: 3:58 PM
 */

namespace App\Repositories\Program;

interface IProgramRepository
{
    public function getAllProgram();
    public function getProgramById($id);
    public function saveProgram(array $attributes);
    public function updateProgram($id, array $attributes);
    public function deleteProgram($id);
}
