<?php

namespace App\Repository;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use stdClass;

class RegionRepository
{
    private $baseUrl = "https://dev.farizdotid.com/api/daerahindonesia";

    public function province(int $id = null)
    {
        $provinces = $this->getFromCache('provinces');

        if(!$provinces) {
            $data = Http::get("{$this->baseUrl}/provinsi")->json();
            $provinces = array_map(function($province) {
                return (object)['id' => $province['id'], 'name' => $province['nama']];
            }, $data['provinsi']);

            $this->saveToCache('provinces', $provinces);
        }

        if(!is_null($id)) return $this->getByID($provinces, $id);

        return $provinces;
    }

    public function district(int $provID, int $id = null)
    {
        $districts = $this->getFromCache("districts_{$provID}");

        if(!$districts) {
            $data = Http::get("{$this->baseUrl}/kota?id_provinsi={$provID}")->json();
            $districts = array_map(function($district) {
                return (object)[
                    'id' => $district['id'],
                    'province_id' => $district['id_provinsi'],
                    'name' => $district['nama']
                ];
            }, $data['kota_kabupaten']);

            $this->saveToCache("districts_{$provID}", $districts);
        }

        if(!is_null($id)) return $this->getByID($districts, $id);

        return $districts;
    }

    public function sub_district(int $distID, int $id = null)
    {
        $sDistricts = $this->getFromCache("sDistricts_{$distID}");

        if(!$sDistricts) {
            $data = Http::get("{$this->baseUrl}/kecamatan?id_kota={$distID}")->json();
            $sDistricts = array_map(function($sDistrict) {
                return (object)[
                    'id' => $sDistrict['id'],
                    'district_id' => $sDistrict['id_kota'],
                    'name' => $sDistrict['nama']
                ];
            }, $data['kecamatan']);

            $this->saveToCache("sDistricts_{$distID}", $sDistricts);
        }

        if(!is_null($id)) return $this->getByID($sDistricts, $id);

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

    private function getByID(array $params, int $id)
    {
        $result = current(array_filter($params, function($data) use($id) {
            return $data->id == $id;
        }));

        return !$result ? null : $result;
    }
}
