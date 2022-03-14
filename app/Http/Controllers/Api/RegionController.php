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
        return $this->repo->province();
    }

    public function districts(int $id)
    {
        return $this->repo->district($id);
    }

    public function subDistricts(int $id)
    {
        return $this->repo->sub_district($id);
    }
}
