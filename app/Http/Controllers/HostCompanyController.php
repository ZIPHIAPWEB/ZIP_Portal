<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperAdminResource;
use App\Repositories\HostCompany\HostCompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HostCompanyController extends Controller
{
    private $hostCompanyRepository;
    public function __construct(HostCompanyRepository $hostCompanyRepository)
    {
        $this->hostCompanyRepository = $hostCompanyRepository;
    }

    public function viewHost()
    {
        $hosts = $this->hostCompanyRepository->getAllHostCompany();

        return SuperAdminResource::collection($hosts);
    }

    public function storeHost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'state' =>  'required'
        ])->validate();

        $this->hostCompanyRepository->saveHostCompany([
            'name'  =>  $request->input('name'),
            'states' =>  $request->input('state')
        ]);

        return response()->json(['message'  =>  'Stored!']);
    }

    public function editHost($id)
    {
        $host = $this->hostCompanyRepository->getHostCompanyById($id);

        return new SuperAdminResource($host);
    }

    public function updateHost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'state' =>  'required'
        ])->validate();

        $this->hostCompanyRepository->updateHostCompany($id, [
            'name'  =>  $request->input('name'),
            'states' =>  $request->input('state')
        ]);

        return response()->json(['message'  =>  'Updated!']);
    }

    public function deleteHost($id)
    {
        $this->hostCompanyRepository->deleteHostCompany($id);

        return response()->json(['message'  =>  'Deleted!']);
    }
}
