<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 6:24 PM
 */

namespace App\Repositories\Base;


use Illuminate\Support\Collection;

interface IBaseRepository
{
    public function findAll();
    public function findBy(array $where);
    public function findWith(array $relations);
    public function findByWhereWith(array $where, array $relations);
    public function save(array $attributes);
    public function update($id, array $attributes);
    public function whereUpdate(array $where, array $attributes);
    public function delete($id);
}