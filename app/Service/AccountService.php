<?php

namespace App\Service;

use App\Models\User;
use App\Repository\RegionRepository;

class AccountService
{
    public static function isComplete(User $user): bool
    {
        return static::check(
            $user->name,
            $user->email,
            $user->province,
            $user->district,
            $user->sub_district,
            $user->institution,
            $user->phone,
        );
    }

    public static function region(User $user): object
    {
        $repo = new RegionRepository;

        return (object)[
            'provinces' => $repo->province(),
            'districts' => $user->province ? $repo->district($user->province) : [],
            'sub_districts' => $user->district ? $repo->sub_district($user->district) : []
        ];
    }

    private static function check(...$params): bool
    {
        $result = [];

        foreach($params as $param) {
            $result[] = match(gettype($param)) {
                'string' => strlen($param) > 1 ? true : false,
                'NULL' => false
            };
        }

        return in_array(false, $result) ? false : true;
    }
}
