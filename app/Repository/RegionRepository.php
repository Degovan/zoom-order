<?php

namespace App\Repository;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class RegionRepository
{
    private $baseUrl = "https://dev.farizdotid.com/api/daerahindonesia";

    public function province()
    {
        $provinces = $this->getFromCache('provinces');

        if(!$provinces) {
            $data = Http::get("{$this->baseUrl}/provinsi")->json();
            $provinces = array_map(function($province) {
                return (object)['id' => $province['id'], 'name' => $province['nama']];
            }, $data['provinsi']);

            $this->saveToCache('provinces', $provinces);
        }

        return $provinces;
    }

    public function district(int $id)
    {
        $districts = $this->getFromCache("districts_{$id}");

        if(!$districts) {
            $data = Http::get("{$this->baseUrl}/kota?id_provinsi={$id}")->json();
            $districts = array_map(function($district) {
                return (object)[
                    'id' => $district['id'],
                    'province_id' => $district['id_provinsi'],
                    'name' => $district['nama']
                ];
            }, $data['kota_kabupaten']);

            $this->saveToCache("districts_{$id}", $districts);
        }

        return $districts;
    }

    public function sub_district(int $id)
    {
        $sDistricts = $this->getFromCache("sDistricts_{$id}");

        if(!$sDistricts) {
            $data = Http::get("{$this->baseUrl}/kecamatan?id_kota={$id}")->json();
            $sDistricts = array_map(function($sDistrict) {
                return (object)[
                    'id' => $sDistrict['id'],
                    'district_id' => $sDistrict['id_kota'],
                    'name' => $sDistrict['nama']
                ];
            }, $data['kecamatan']);

            $this->saveToCache("sDistricts_{$id}", $sDistricts);
        }

        return $sDistricts;
    }

    private function getFromCache(string $name)
    {
        $storage = Storage::disk('local');
        $path = "regions/{$name}.json";
        
        if(!$storage->exists($path)) return null;

        $content = json_decode($storage->get($path));

        if(($content->timestamp ?? 0) + 172800 <= time()) return null;
        return $content->data;
    }

    private function saveToCache(string $name, array $data): void
    {
        $storage = Storage::disk('local');

        if(!$storage->exists('regions')) $storage->makeDirectory('regions');

        $storage->put("regions/{$name}.json", json_encode([
            'data' => $data,
            'timestamp' => time()
        ]));
    }
}
