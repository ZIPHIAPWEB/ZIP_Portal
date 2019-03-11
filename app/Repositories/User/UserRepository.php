<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/4/2019
 * Time: 2:07 PM
 */

namespace App\Repositories\User;


use App\Repositories\Base\BaseRepository;
use App\User;

class UserRepository extends BaseRepository implements IUserRepository
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}