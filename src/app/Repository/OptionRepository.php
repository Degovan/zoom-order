<?php

namespace App\Repository;

use App\Models\Option;

class OptionRepository
{
    public function get(string $key, bool $isJson = false): string|object|null
    {
        $option = Option::where('key', $key)->first();

        if($option && $isJson) return json_decode($option->value);
        return $option->value ?? null;
    }

    public function save($key, $value = null, bool $isJson = false)
    {
        if(is_array($key)) {
            return array_map(function($option) {
                return $this->update($option['key'], $option['value'], $option['json']);
            }, $key);
        }

        return $this->update($key, $value, $isJson);
    }

    private function update(string $key, $value, bool $isJson = false): Option
    {
        $option = Option::where('key', $key)->first();
        $value = $isJson ? json_encode($value) : $value;

        if($option) {
            $option->update(['value' => $value]);
            return $option;
        }

        return Option::create(['key' => $key, 'value' => $value]);
    }
}
