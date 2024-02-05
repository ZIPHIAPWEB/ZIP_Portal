<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Repositories\Sponsor\SponsorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SponsorController extends Controller
{
    private $sponsorRepository;
    public function __construct(SponsorRepository $sponsorRepository)
    {
        $this->sponsorRepository = $sponsorRepository;
    }

    public function view()
    {
        $sponsors = $this->sponsorRepository->getAllSponsor();

        return SuperAdminResource::collection($sponsors);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'display_name'  =>  'required',
            'description'   =>  'required'
        ])->validate();

        $this->sponsorRepository->saveSponsor([
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Sponsor Added']);
    }

    public function edit($id)
    {
        $sponsor = $this->sponsorRepository->getSponsorById($id);

        return new SuperAdminResource($sponsor);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'display_name'  =>  'required',
            'description'   =>  'required'
        ])->validate();

        $this->sponsorRepository->update($id, [
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'description'   =>  $request->input('description')
        ]);

        return response()->json(['message'  =>  'Sponsor Updated']);
    }

    public function delete($id)
    {
        $this->sponsorRepository->deleteSponsor($id);

        return response()->json(['message'  =>  'Sponsor Deleted']);
    }
}
