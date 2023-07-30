<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Pricing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = Package::create([
            'title' => 'Paket Eksklusif',
            'summary' => 'Full 1 hari',
            'items' => [
                'Unlimited zoom meet',
                'Host with HostKey',
                'Breakout Room'
            ]
        ]);

        Pricing::insert([
            [
                'package_id' => $package->id,
                'max_audience' => 250,
                'cost' => 30000,
                'discount' => 0
            ],
            [
                'package_id' => $package->id,
                'max_audience' => 500,
                'cost' => 45000,
                'discount' => 0
            ]
        ]);
    }
}
