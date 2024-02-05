<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Repositories\Event\EventRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    private $eventRepository;
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function view()
    {
        $events = $this->eventRepository->getAllEvent();

        return SuperAdminResource::collection($events);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'date'          =>  'required',
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        $event = $this->eventRepository->saveEvent([
            'date'          =>  $request->input('date'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return new SuperAdminResource($event);
    }

    public function edit($id)
    {
        $event = $this->eventRepository->getEventById($id);

        return new SuperAdminResource($event);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'date'          =>  'required',
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        $event = $this->eventRepository->updateEvent($id, [
            'date'          =>  $request->input('date'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return new SuperAdminResource($event);
    }

    public function delete($id)
    {
        $event = $this->eventRepository->deleteEvent($id);

        return new SuperAdminResource($event);
    }
}
