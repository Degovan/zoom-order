<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\RegionRepository;

class RegionController extends Controller
{
    protected RegionRepository $repo;

    public function __construct()
    {
        $this->repo = new RegionRepository;
    }

    public function provinces()
    {
        return response()->json($this->repo->province());
    }

    public function districts(int $id)
    {
        return response()->json($this->repo->district($id));
    }

    public function subDistricts(int $id)
    {
        return response()->json($this->repo->sub_district($id));
    }
}
