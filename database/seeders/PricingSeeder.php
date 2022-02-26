<?php

namespace Database\Seeders;

use App\Models\Pricing;
use Illuminate\Database\Seeder;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pricing::create([
            'title' => 'Paket Eksklusif',
            'summary' => 'Durasi tidak terbatas dan maksimal 255 peserta',
            'cost' => 50000,
            'discount' => 10000,
            'items' => [
                'Unlimited zoom meet',
                'Durasi tak terbatas',
                'Maksimal 255 peserta'
            ]
        ]);
    }
}
