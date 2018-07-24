<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Resources\SuperAdminResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function view()
    {
        $events = Event::all();

        return SuperAdminResource::collection($events);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'date'          =>  'required',
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        $event = Event::create([
            'date'          =>  $request->input('date'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return new SuperAdminResource($event);
    }

    public function edit($id)
    {
        $event = Event::find($id);

        return new SuperAdminResource($event);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'date'          =>  'required',
            'name'          =>  'required',
            'description'   =>  'required'
        ])->validate();

        $event = Event::find($id);

        $event->update([
            'date'          =>  $request->input('date'),
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return new SuperAdminResource($event);
    }

    public function delete($id)
    {
        $event = Event::find($id);

        $event->delete();

        return new SuperAdminResource($event);
    }
}
