<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 11:38 AM
 */

namespace App\Repositories\Event;


use App\Event;
use App\Repositories\Base\BaseRepository;

class EventRepository extends BaseRepository implements IEventRepository
{
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    public function saveEvent(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateEvent($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteEvent($id)
    {
        return parent::delete($id);
    }

    public function getAllEvent()
    {
        return parent::findAll();
    }

    public function getEventById($id)
    {
        return parent::findBy(['id' => $id]);
    }
}