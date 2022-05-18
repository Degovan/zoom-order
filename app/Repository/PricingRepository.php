<?php

namespace App\Repository;

use App\Models\Pricing;

class PricingRepository
{
    /**
     * Put package's pricing to database
     * 
     * @param int $id | package id
     * @param array $pricings | pricing data
     */
    public static function put(int $id, array $pricings): void
    {
        Pricing::where('package_id', $id)->delete();

        array_map(function($pricing) use($id) {
            
            $pricing = [
                'max_audience' => $pricing['max_audience'] ?? 0,
                'cost' => $pricing['cost'] ?? 0,
                'discount' => $pricing['discount'] ?? 0,
            ];

            Pricing::create(array_merge(['package_id' => $id], $pricing));
        }, $pricings);
    }
}
