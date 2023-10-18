<?php

namespace App\Http\Controllers\v2;

use App\HostCompany;
use App\Http\Controllers\Controller;
use App\Http\Resources\HostCompanyResource;
use Illuminate\Http\Request;

class HostCompanyController extends Controller
{
    public function getHostCompanies()
    {
        $companies = HostCompany::query()->orderBy('name', 'ASC')->get();

        return HostCompanyResource::collection($companies);
    }
}
