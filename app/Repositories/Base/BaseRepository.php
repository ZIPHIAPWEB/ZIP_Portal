<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 6:23 PM
 */

namespace App\Repositories\Base;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class BaseRepository implements IBaseRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findAll($columns = ['*'], string $orderBy = 'created_at', string $sortBy = 'asc')
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    public function findBy(array $where)
    {
        return $this->model->where($where)->get();
    }

    public function findOneBy(array $where)
    {
        return $this->model->where($where)->first();
    }

    public function findByWhereWith(array $where, array $relations)
    {
        return $this->model->where($where)->with($relations)->get();
    }

    public function findOneByWhereWith(array $where, array $relations)
    {
        return $this->model->where($where)->with($relations)->first();
    }

    public function findWith(array $relations)
    {
        return $this->model->with($relations)->get();
    }

    public function save(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $data = $this->model->findOrFail($id);
        $data->update($attributes);

        return $data;
    }

    public function whereUpdate(array $where, array $attributes)
    {
        return $this->model->where($where)->update($attributes);
    }

    public function delete($id)
    {
        $data = $this->model->findOrFail($id);
        $data->delete();

        return $data;
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [], $baseUrl = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ?
            $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items->forPage($page, $perPage),
            $items->count(),
            $perPage, $page, $options);

        if ($baseUrl) {
            $lap->setPath($baseUrl);
        }

        return $lap;
    }

    public function paginateArrayResult(array $data, int $perPage = 10)
    {
        $page = request()->get('page', 1);
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(
            array_slice($data, $offset, $perPage, false),
            count($data),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query()
            ]
        );
    }
}