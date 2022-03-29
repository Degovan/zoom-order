<?php

namespace App\Support\Attribute;

use App\Repository\RegionRepository;

class Address
{
    private object $attr;
    private RegionRepository $region;

    public function __construct(array $attributes)
    {
        $this->attr = (object)$attributes;
        $this->region = new RegionRepository;
    }

    public function __toString()
    {
        $province = $this->region->province($this->attr->province);
        $district = $this->region->district($province->id, $this->attr->district);
        $subDistr = $this->region->sub_district($district->id, $this->attr->sub_district);

        return "Kec. {$subDistr->name} - {$district->name} - {$province->name}";
    }
}
