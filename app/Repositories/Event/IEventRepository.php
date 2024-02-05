<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 11:38 AM
 */

namespace App\Repositories\Event;

interface IEventRepository
{
    public function getAllEvent();
    public function getEventById($id);
    public function saveEvent(array $attributes);
    public function updateEvent($id, array $attributes);
    public function deleteEvent($id);
}
