<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:47 PM
 */

namespace App\Repositories\Tertiary;


interface ITertiaryRepository
{
    public function saveTertiary(array $attributes);
    public function updateTertiary($id, $attributes);
    public function deleteTertiary($id);
}